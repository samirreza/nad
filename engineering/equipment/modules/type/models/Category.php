<?php

namespace nad\engineering\equipment\modules\type\models;

use yii\db\ActiveRecord;
use core\tree\NestedSetsBehavior;
use nad\common\code\CodableTrait;
use core\behaviors\PreventDeleteBehavior;
use nad\common\code\CodableCategoryBehavior;
use creocoder\nestedsets\NestedSetsQueryBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class Category extends ActiveRecord
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
                        'relationName' => 'زیر گروه'
                    ],
                    [
                        'relationMethod' => 'getTypes',
                        'relationName' => 'نوع تجهیز'
                    ]
                ]
            ],
            'tree' => [
                'class' => NestedSetsBehavior::class,
                'treeAttribute' => 'tree'
            ],
            CodableCategoryBehavior::class
        ];
    }

    public function rules()
    {
        return [
            [['title', 'parentId', 'code'], 'required'],
            ['code', 'string', 'min' => 2, 'max' => 3],
            [['title', 'code'], 'trim'],
            ['title', 'string', 'max' => 255],
            ['title', FarsiCharactersValidator::class]
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
            'compositeCode' => 'شناسه یکتا',
            'parentId' => 'رده پدر'
        ];
    }

    public function getTypes()
    {
        return $this->hasMany(Type::class, ['categoryId' => 'id']);
    }

    public function getUniqueCode()
    {
        if ($this->parent == null) {
            return $this->code;
        }
        return $this->parent->getUniqueCode() . '.' . $this->code;
    }

    public static function tableName()
    {
        return 'nad_equipment_type_category';
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
