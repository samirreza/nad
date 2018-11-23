<?php

namespace nad\extensions\documentation\models;

use core\behaviors\TimestampBehavior;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class File extends \yii\db\ActiveRecord
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
                            'maxSize' => 5 * 1024 * 1024,
                            'required' => true
                        ]
                    ]
                ]
            ]
        ];
    }

    public function rules()
    {
        return [
            ['documentationId', 'required'],
            ['description', 'string'],
            ['description', FarsiCharactersValidator::class],
            ['title', 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'title' => 'عنوان',
            'description' => 'توضیحات',
            'createdAt' => 'تاریخ بارگذاری',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getUrl()
    {
        $file = $this->getFile('file');
        if (!$file) {
            return '#';
        }
        return $file->getUrl();
    }

    public function formName()
    {
        return 'documentationFile';
    }

    public static function tableName()
    {
        return 'module_documentation_file';
    }
}
