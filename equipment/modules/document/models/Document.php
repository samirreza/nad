<?php

namespace modules\nad\equipment\modules\document\models;

use extensions\file\behaviors\FileBehavior;

class Document extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
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
            'documentTypeId' => 'نوع سند'
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
