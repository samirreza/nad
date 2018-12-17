<?php

namespace nad\research\modules\material\models;

use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use core\behaviors\TimestampBehavior;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class Type extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => FileBehavior::class,
                'groups' => [
                    'file' => [
                        'type' => FileBehavior::TYPE_FILE,
                        'rules' => [
                            'extensions' => ['png', 'jpg', 'jpeg', 'pdf', 'docx', 'doc', 'xlsx'],
                            'maxSize' => 5 * 1024 * 1024
                        ]
                    ],
                ]
            ]
        ];
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
            [['title'], FarsiCharactersValidator::class],
            [
                'code',
                'unique',
                'targetAttribute' => ['code', 'categoryId'],
                'message' => 'این شناسه نوع ماده پیش تر ثبت شده است.'
            ]
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

    public function beforeValidate()
    {
        $this->code = strtoupper($this->code);
        return parent::beforeValidate();
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'categoryId']);
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }

    public function beforeSave($insert)
    {
        $this->setUniqueCode();
        return parent::beforeSave($insert);
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->category->uniqueCode . '.' . $this->code;
    }

    public static function tableName()
    {
        return 'nad_material_type';
    }
}
