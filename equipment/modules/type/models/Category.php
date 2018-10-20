<?php
namespace modules\nad\equipment\modules\type\models;

use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use nad\common\code\CodableCategoryBehavior;
use yii\helpers\ArrayHelper;
use core\behaviors\NestedSetsBehavior;
use core\behaviors\PreventDeleteBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class Category extends \yii\db\ActiveRecord
{
    use CodableTrait;

    public static function tableName()
    {
        return 'nad_equipment_type_category';
    }

    public function behaviors()
    {
        return [
            CodableCategoryBehavior::class,
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
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['title', 'parentId', 'code'], 'required'],
            ['code', 'string', 'min' => 2, 'max' => 3],
            [['title', 'code'], 'trim'],
            ['title', 'string', 'max' => 255],
            [['title'], FarsiCharactersValidator::className()]
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
            'parentId' => 'رده پدر',
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        $query = parent::find();
        $query->attachBehavior(
            'nestedQuery',
            'creocoder\nestedsets\NestedSetsQueryBehavior'
        );
        return $query->orderBy(['tree' => SORT_DESC,'lft' => SORT_ASC]);
    }

    public function getTypes()
    {
        return $this->hasMany(Type::className(), ['categoryId' => 'id']);
    }

    public function getUniqueCode()
    {
        if ($this->parent == null) {
            return $this->code;
        }
        return $this->parent->getUniqueCode().'.'.$this->code;
    }
}
