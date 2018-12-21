<?php

namespace nad\research\modules\resource\models;

use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use core\behaviors\TimestampBehavior;
use extensions\file\behaviors\FileBehavior;
use nad\research\common\behaviors\SettingCodeBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class Resource extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    const TYPE_BOOK = 'B';
    const TYPE_PAPER = 'P';
    const TYPE_CATALOGUE = 'C';
    const TYPE_THESIS = 'T';

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => FileBehavior::class,
                'groups' => [
                    'resource' => [
                        'type' => FileBehavior::TYPE_FILE,
                        'rules' => [
                            'extensions' => [
                                'png',
                                'jpg',
                                'jpeg',
                                'pdf',
                                'doc',
                                'docx',
                                'xls',
                                'xlsx',
                                'ppt',
                                'pptx'
                            ],
                            'maxSize' => 5 * 1024 * 1024,
                            'required' => true
                        ]
                    ]
                ]
            ],
            [
                'class' => SettingCodeBehavior::class,
                'determinativeColumn' => 'type'
            ]
        ];
    }

    public function rules()
    {
        return [
            [['title', 'type'], 'required'],
            [['title', 'type'], 'trim'],
            ['title', 'string', 'max' => 255],
            ['description', 'string'],
            [['title', 'description'], FarsiCharactersValidator::class],
            [['title', 'description'], 'default', 'value' => null]
        ];
    }

    public function attributeLabels()
    {
        return [
            'uniqueCode' => 'شناسه',
            'type' => 'نوع',
            'title' => 'عنوان',
            'description' => 'توضیحات',
            'createdAt' => 'تاریخ درج منبع'
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->setUniqueCode();
        return true;
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->type . '.' . $this->lastCodePart;
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }

    public static function tableName()
    {
        return 'nad_research_resource';
    }

    public static function getTypeLabels()
    {
        return [
            self::TYPE_BOOK => 'کتاب',
            self::TYPE_PAPER => 'مقاله',
            self::TYPE_CATALOGUE => 'بروشور',
            self::TYPE_THESIS => 'پایان نامه'
        ];
    }
}
