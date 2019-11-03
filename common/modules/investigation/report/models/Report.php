<?php

namespace nad\common\modules\investigation\report\models;

use extensions\file\behaviors\FileBehavior;
use extensions\auditTrail\behaviors\AuditTrailBehavior;

class Report extends ReportCommon
{
    public $moduleId = 'report';

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => AuditTrailBehavior::class,
                    'relations' => [
                        'referencesAsString',
                        'partnerFullNamesAsString',
                        'tagsAsString', // TODO has bugs, fix it!
                        'expertAsString',
                        'sourceAsString',
                        'proposalAsString'
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
