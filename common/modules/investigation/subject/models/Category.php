<?php

namespace nad\common\modules\investigation\subject\models;

use yii\db\ActiveRecord;
use nad\common\code\Codable;
use core\tree\NestedSetsBehavior;
use nad\common\code\CodableTrait;
use core\behaviors\PreventDeleteBehavior;
use nad\common\code\CodableCategoryBehavior;
use creocoder\nestedsets\NestedSetsQueryBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class Category extends ActiveRecord implements Codable
{
    use CodableTrait;

    public function behaviors()
    {
        return [
            [
                'class' => PreventDeleteBehavior::class,
                'relations' => [
                    [
                        'relationMethod' => 'children',
                        'relationName' => 'زیر رده'
                    ],
                    [
                        'relationMethod' => 'getSubjects',
                        'relationName' => 'موضوع'
                    ]
                ]
            ],
            'tree' => [
                'class' => NestedSetsBehavior::class,
                'treeAttribute' => 'tree'
            ],
            [
                'class' => CodableCategoryBehavior::class,
                'leafsDepth' => 3
            ]
        ];
    }

    public function rules()
    {
        return [
            [['title', 'parentId', 'code'], 'required'],
            [['title', 'code'], 'trim'],
            ['title', 'string', 'max' => 255],
            ['code', 'string', 'min' => 1, 'max' => 3],
            ['title', FarsiCharactersValidator::class]
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'شناسه',
            'title' => 'عنوان',
            'depth' => 'رده',
            'nestedTitle' => 'عنوان',
            'uniqueCode' => 'شناسه یکتا',
            'parentId' => 'رده پدر'
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert) {
            $this->consumer = static::CONSUMER_CODE;
        }
        return true;
    }

    public function getUniqueCode() : string
    {
        if ($this->parent == null) {
            return $this->code;
        }
        return $this->parent->getUniqueCode() . '.' . $this->code;
    }

    public function getSubjects()
    {
        return $this->hasMany(Subject::class, ['categoryId' => 'id']);
    }

    public function getFamilyTreeArrayForWidget()
    {
        $attributes = [
            'id' => $this->id,
            'name' => $this->htmlCodedTitle,
            'code' => $this->uniqueCode,
            'depth' => $this->depth
        ];
        if ($this->children(1)->count() != 0) {
            $children = [];
            foreach ($this->children(1)->all() as $child) {
                $children[] = $child->getFamilyTreeArrayForWidget();
            }
        } elseif ($this->getSubjects()->count() != 0) {
            foreach ($this->subjects as $subject) {
                $children[] = [
                    'id' => $subject->id,
                    'name' => $subject->htmlCodedTitle,
                    'code' => $subject->uniqueCode,
                    'depth' => $this->leafsDepth + 1
                ];
            }
        }
        if (!empty($children)) {
            $attributes['children'] = $children;
        }

        return $attributes;
    }

    public function getDepthList()
    {
        return [
            0 => 'نوع مدرک',
            1 => 'فعالیت',
            2 => 'واحد',
            3 => 'شاخه',
            // 4 => 'رده 5',
            // 5 => 'رده 6',
        ];
    }

    public function updateChildrenCodes()
    {
        if ($this->children(1)->count() != 0) {
            foreach ($this->children(1)->all() as $child) {
                $child->updateChildrenCodes();
            }
        } elseif ($this->getSubjects()->count() != 0) {
            foreach ($this->subjects as $subject) {
                $subject->setUniqueCode();
                $subject->save(false);
            }
        }
    }

    public static function tableName()
    {
        return 'nad_investigation_subject_category';
    }

    public static function find()
    {
        $query = parent::find();
        $query->attachBehavior(
            'nestedQuery',
            NestedSetsQueryBehavior::class
        );
        return $query;
    }
}
