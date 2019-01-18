<?php

namespace nad\research\investigation\project\models;

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
                        'relationMethod' => 'getProjects',
                        'relationName' => 'گزارش'
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
                    'id' => $project->id,
                    'name' => $project->htmlCodedTitle,
                    'code' => $project->uniqueCode,
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

    public static function tableName()
    {
        return 'nad_research_project_category';
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
