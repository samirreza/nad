<?php
namespace modules\nad\equipment\modules\type\models;

use core\behaviors\PreventDeleteBehavior;
use modules\nad\equipment\modules\type\details;
use extensions\i18n\validators\FarsiCharactersValidator;

class Type extends \modules\nad\equipment\models\Type
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'core\behaviors\TimestampBehavior',
                [
                    'class' => PreventDeleteBehavior::class,
                    'relations' => [
                        [
                            'relationMethod' => 'getParts',
                            'relationName' => 'قطعه'
                        ],
                        [
                            'relationMethod' => 'getFittings',
                            'relationName' => 'اتصال'
                        ]
                    ]
                ]
            ]
        );
    }

    public function rules()
    {
        return [
            [['title', 'categoryId', 'code'], 'required'],
            [['title', 'code'], 'trim'],
            ['title', 'string', 'max' => 255],
            ['code', 'string', 'max' => 1, 'min' => 1],
            [['categoryId'], 'integer'],
            [['description'], 'string'],
            [['title'], FarsiCharactersValidator::className()],
            [
                'code',
                'unique',
                'targetAttribute' => ['code', 'categoryId'],
                'message' => 'این شناسه نوع تجهیز پیش تر ثبت شده است.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'شناسه نوع تجهیز',
            'compositeCode' => 'شناسه نوع تجهیز',
            'title' => 'عنوان',
            'description' => 'توضیحات',
            'categoryId' => 'شاخه',
            'category.title' => 'شاخه',
            'category.familyTreeTitle' => 'شاخه',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'categoryId']);
    }

    public function getParts()
    {
        return $this->hasMany(
            details\models\Part::className(),
            ['typeId' => 'id']
        );
    }

    public function getFittings()
    {
        return $this->hasMany(
            details\models\Fitting::className(),
            ['typeId' => 'id']
        );
    }

    public function beforeValidate()
    {
        $this->code = strtoupper($this->code);
        return parent::beforeValidate();
    }

    public function getCompositeCode()
    {
        return $this->category->compositeCode . '. ' . $this->code;
    }
}
