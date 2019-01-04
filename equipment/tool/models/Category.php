<?php

namespace nad\equipment\tool\models;

use nad\common\code\Codable;
use core\tree\NestedSetsBehavior;
use nad\common\code\CodableTrait;
use core\behaviors\PreventDeleteBehavior;
use nad\common\code\CodableCategoryBehavior;
use creocoder\nestedsets\NestedSetsQueryBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class Category extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    public function behaviors()
    {
        return [
            [
                'class' => CodableCategoryBehavior::class,
                'leafsDepth' => 2
            ],
            [
                'class' => PreventDeleteBehavior::class,
                'relations' => [
                    [
                        'relationMethod' => 'children',
                        'relationName' => 'زیر رده'
                    ],
                    [
                        'relationMethod' => 'getTypes',
                        'relationName' => 'نوع ابزار'
                    ]
                ]
            ],
            'tree' => [
                'class' => NestedSetsBehavior::class,
                'treeAttribute' => 'tree',
            ]
        ];
    }

    public function rules()
    {
        return [
            [['title', 'parentId', 'code'], 'required'],
            [['title', 'code'], 'trim'],
            ['title', 'string', 'max' => 255],
            [['title'], FarsiCharactersValidator::class],
            ['code', 'string', 'min' => 1, 'max' => 3]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'depth' => 'رده',
            'title' => 'عنوان',
            'nestedTitle' => 'عنوان',
            'code' => 'شناسه رده',
            'uniqueCode' => 'شناسه یکتا',
            'parentId' => 'رده پدر',
        ];
    }

    public function getUniqueCode() : string
    {
        if ($this->parent == null) {
            return $this->code;
        }
        return $this->parent->getUniqueCode() . '.' . $this->code;
    }

    public function getTypes()
    {
        return $this->hasMany(Tool::class, ['categoryId' => 'id']);
    }

    public function getDepthList()
    {
        return [
            0 => 'گروه',
            1 => 'دسته',
            2 => 'زیر دسته'
        ];
    }

    public static function tableName()
    {
        return 'nad_equipment_tool_category';
    }

    public static function find()
    {
        $query = parent::find();
        $query->attachBehavior(
            'nestedQuery',
            NestedSetsQueryBehavior::class
        );
        return $query->orderBy(['tree' => SORT_DESC, 'lft' => SORT_ASC]);
    }
}
