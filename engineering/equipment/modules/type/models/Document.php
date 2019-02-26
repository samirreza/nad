<?php

namespace nad\engineering\equipment\modules\type\models;

use core\behaviors\TimestampBehavior;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\engineering\equipment\modules\type\behaviors\NotificationBehavior;

class Document extends \yii\db\ActiveRecord
{
    const EVENT_DOCUMENT_INSERTED = 'documentInserted';

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
                            ]
                        ]
                    ]
                ]
            ],
            NotificationBehavior::class
        ];
    }

    public function rules()
    {
        return [
            [['title', 'equipmentTypeId'], 'required'],
            [['title', 'uniqueCode', 'archivesAddress'], 'trim'],
            [['title', 'archivesAddress'], 'string', 'max' => 255],
            ['description', 'string'],
            [['title', 'description'], FarsiCharactersValidator::class],
            [
                'uniqueCode',
                'unique',
                'targetAttribute' => ['uniqueCode', 'equipmentTypeId'],
                'message' => 'این شناسه مدرک پیش تر ثبت شده است.'
            ],
            [
                'equipmentTypeId',
                'exist',
                'targetClass' => Type::class,
                'targetAttribute' => ['equipmentTypeId' => 'id']
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'uniqueCode' => 'شناسه مدرک',
            'title' => 'عنوان',
            'description' => 'توضیحات',
            'archivesAddress' => 'آدرس هارد کپی',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->trigger(self::EVENT_DOCUMENT_INSERTED);
        parent::afterSave($insert, $changedAttributes);
    }

    public function getEquipmentType()
    {
        return $this->hasOne(Type::class, ['id' => 'equipmentTypeId']);
    }

    public static function tableName()
    {
        return 'nad_end_equipment_document';
    }
}
