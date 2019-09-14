<?php

namespace nad\build\material\models;

use yii\db\ActiveRecord;
use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use core\behaviors\TimestampBehavior;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class Material extends ActiveRecord implements Codable
{
    use CodableTrait;

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                TimestampBehavior::class,
                [
                    'class' => FileBehavior::class,
                    'groups' => [
                        'file' => [
                            'type' => FileBehavior::TYPE_FILE,
                            'rules' => [
                                'extensions' => [
                                    'png',
                                    'jpg',
                                    'jpeg',
                                    'pdf',
                                    'docx',
                                    'doc',
                                    'xlsx'
                                ],
                                'maxSize' => 5 * 1024 * 1024
                            ]
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
            ['description', 'string'],
            ['categoryId', 'integer'],
            [
                'code',
                'unique',
                'targetAttribute' => ['code', 'categoryId'],
                'message' => 'این شناسه پیش تر ثبت شده است.'
            ],
            [['title', 'description'], FarsiCharactersValidator::class]
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'شناسه ماده',
            'uniqueCode' => 'شناسه ماده',
            'title' => 'عنوان',
            'description' => 'توضیحات',
            'categoryId' => 'زیر شاخه',
            'category.title' => 'زیر شاخه',
            'category.familyTreeTitle' => 'زیر شاخه',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'categoryId']);
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
        $this->uniqueCode = $this->category->uniqueCode . '.' . $this->code;
    }

    public static function tableName()
    {
        return 'nad_build_material';
    }
}
