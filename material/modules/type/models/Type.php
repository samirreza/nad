<?php
namespace modules\nad\material\modules\type\models;

use extensions\i18n\validators\FarsiCharactersValidator;

class Type extends \modules\nad\material\models\Type
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'core\behaviors\TimestampBehavior'
            ]
        );
    }

    public function rules()
    {
        return [
            [['title', 'categoryId', 'code'], 'required'],
            [['title', 'code', 'titleEn'], 'trim'],
            [['title', 'titleEn'], 'string', 'max' => 255],
            ['code', 'string', 'max' => 1, 'min' => 1],
            [['categoryId'], 'integer'],
            [['description'], 'string'],
            [['title'], FarsiCharactersValidator::className()],
            [
                'code',
                'unique',
                'targetAttribute' => ['code', 'categoryId'],
                'message' => 'این شناسه نوع ماده پیش تر ثبت شده است.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'شناسه نوع ماده',
            'uniqueCode' => 'شناسه نوع ماده',
            'title' => 'عنوان',
            'titleEn' => 'عنوان لاتین',
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

    public function beforeValidate()
    {
        $this->code = strtoupper($this->code);
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        $this->setUniqueCode();
        return parent::beforeSave($insert);
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->category->compositeCode . '.' . $this->code;
    }
}
