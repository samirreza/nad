<?php

namespace nad\common\modules\investigation\subject\models;

use extensions\file\behaviors\FileBehavior;
use extensions\auditTrail\behaviors\AuditTrailBehavior;

class Subject extends SubjectCommon
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => AuditTrailBehavior::class,
                    'relations' => [
                        'expertFullNamesAsString',
                        'researcherTitle'
                    ]
                ],
                [
                    'class' => FileBehavior::className(),
                    'groups' => [
                        'file' => [
                            'type' => FileBehavior::TYPE_FILE,
                            'rules' => [
                                'extensions' => ['png', 'jpg', 'jpeg', 'pdf', 'docx', 'doc', 'xlsx'],
                                'maxSize' => 5*1024*1024,
                                'required' => true
                            ]
                        ],
                    ]
                ]
            ]
        );
    }

    public static function find()
    {
        return parent::find()->andWhere(['isArchived' => self::IS_SOURCE_ARCHIVED_NO]);
    }
}
