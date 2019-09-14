<?php

namespace nad\engineering\equipment\modules\document\models;

use yii\db\ActiveRecord;
use core\behaviors\TimestampBehavior;
use extensions\file\behaviors\FileBehavior;

class Document extends ActiveRecord
{
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
                                ],
                            'maxSize' => 5 * 1024 * 1024
                        ]
                    ]
                ]
            ]
        ];
    }

    public function rules()
    {
        return [
            ['documentTypeId', 'required'],
            [['equipmentTypeId', 'documentTypeId'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'documentTypeId' => 'نوع سند',
            'createdAt' => 'تاریخ بارگذاری',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getDocumentType()
    {
        return $this->hasOne(DocumentType::class, ['id' => 'documentTypeId']);
    }

    public static function tableName()
    {
        return 'nad_equipment_type_document';
    }
}
