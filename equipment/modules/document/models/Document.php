<?php

namespace modules\nad\equipment\modules\document\models;

use extensions\file\behaviors\FileBehavior;

class Document extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'nad_equipment_document';
    }

    public function behaviors()
    {
        return [
            'core\behaviors\TimestampBehavior',
            [
                'class' => FileBehavior::className(),
                'groups' => [
                    'file' => [
                        'type' => FileBehavior::TYPE_FILE,
                        'rules' => [
                            'extensions' =>
                                [
                                    'png',
                                    'jpg',
                                    'jpeg',
                                    'pdf',
                                    'doc',
                                    'docx',
                                    'xls',
                                    'xlsx',
                                    'ppt',
                                    'pptx',
                                ],
                            'maxSize' => 5 * 1024 * 1024,
                        ]
                    ],
                ]
            ]
        ];
    }

    public function rules()
    {
        return [
            [['documentId'], 'required',],
            [['typeId', 'documentId'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'documentId' => 'نوع سند',
            'document' => 'سند',
            'createdAt' => 'تاریخ ثبت',
        ];
    }

    public function getDocType()
    {
        return $this->hasOne(DocumentType::class, ['id' => 'documentId']);
    }
}