<?php

namespace nad\common\modules\engineering\stage\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use nad\common\code\Codable;
use core\tree\NestedSetsBehavior;
use nad\common\code\CodableTrait;
use core\behaviors\PreventDeleteBehavior;
use nad\common\code\CodableCategoryBehavior;
use creocoder\nestedsets\NestedSetsQueryBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\engineering\location\models\Location;

class Category extends ActiveRecord implements Codable
{
    use CodableTrait;

    public static function tableName()
    {
        return 'nad_eng_stage_category';
    }

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
                        'relationMethod' => 'getTypes',
                        'relationName' => 'نوع تجهیز'
                    ]
                ]
            ],
            'tree' => [
                'class' => NestedSetsBehavior::class,
                'treeAttribute' => 'tree',
            ],
            [
                'class' => CodableCategoryBehavior::class,
                'leafsDepth' => 4
            ]
        ];
    }

    public function rules()
    {
        return [
            [['title', 'parentId', 'code'], 'required'],
            [['title', 'code'], 'trim'],
            ['title', 'string', 'max' => 255],
            ['title', FarsiCharactersValidator::class],
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
            'locations' => 'بسته مدارک',
        ];
    }

    public static function find()
    {
        $query = parent::find();
        $query->attachBehavior(
            'nestedQuery',
            NestedSetsQueryBehavior::class
        );
        return $query->orderBy(['tree' => SORT_DESC,'lft' => SORT_ASC]);
    }

    public function getUniqueCode() : string
    {
        if ($this->parent == null) {
            return $this->code;
        }
        return $this->parent->getUniqueCode().'.'.$this->code;
    }

    public function getTypes()
    {
        return $this->hasMany(Stage::class, ['categoryId' => 'id']);
    }

    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['id' => 'locationId'])->viaTable('nad_eng_location_stage', ['stageCategoryId' => 'id']);
    }

    public function getDepthList()
    {
        return [
            0 => 'گروه',
            1 => 'دسته',
            2 => 'زیر دسته',
            3 => 'شاخه',
            4 => 'زیر شاخه'
        ];
    }


    public function getAllLocationsAsDropdown(){
        return ArrayHelper::map(
            Location::find()->select(['id', 'title'])->all(),
            'id',
            'title'
        );
    }
}
