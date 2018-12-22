<?php

namespace nad\research\modules\project\models;

use nad\common\code\Codable;
use core\tree\NestedSetsBehavior;
use nad\common\code\CodableTrait;
use core\behaviors\PreventDeleteBehavior;
use nad\common\code\CodableCategoryBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class Category extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    public function behaviors()
    {
        return [
            [
                'class' => CodableCategoryBehavior::class,
                'leafsDepth' => 3
            ],
            [
                'class' => PreventDeleteBehavior::class,
                'relations' => [
                    [
                        'relationMethod' => 'children',
                        'relationName' => 'زیر رده'
                    ],
                    [
                        'relationMethod' => 'getProjects',
                        'relationName' => 'گزارش'
                    ]
                ]
            ],
            'tree' => [
                'class' => NestedSetsBehavior::class,
                'treeAttribute' => 'tree'
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

    public function getUniqueCode() : string
    {
        if ($this->parent == null) {
            return $this->code;
        }
        return $this->parent->getUniqueCode() . '.' . $this->code;
    }

    public function getProjects()
    {
        return $this->hasMany(Project::class, ['categoryId' => 'id']);
    }

    public function getFamilyTreeArray()
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
                $children[] = $child->getFamilyTreeArray();
            }
        } elseif ($this->getProjects()->count() != 0) {
            foreach ($this->projects as $project) {
                $children[] = [
                    'id' => $type->id,
                    'name' => $type->htmlCodedTitle,
                    'code' => $type->uniqueCode,
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
            0 => 'گروه',
            1 => 'دسته بندی مطالعاتی',
            2 => 'دسته',
            3 => 'بخش'
        ];
    }

    public function updateChildrenCodes()
    {
        if ($this->children(1)->count() != 0) {
            foreach ($this->children(1)->all() as $child) {
                $child->updateChildrenCodes();
            }
        } elseif ($this->getProjects()->count() != 0) {
            foreach ($this->projects as $project) {
                $project->setUniqueCode();
                $project->save(false);
            }
        }
    }

    public static function find()
    {
        $query = parent::find();
        $query->attachBehavior(
            'nestedQuery',
            'creocoder\nestedsets\NestedSetsQueryBehavior'
        );
        return $query->orderBy(['tree' => SORT_DESC, 'lft' => SORT_ASC]);
    }

    public static function tableName()
    {
        return 'nad_research_project_category';
    }
}