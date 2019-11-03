<?php

namespace nad\common\modules\investigation\method\models;

use extensions\file\behaviors\FileBehavior;
use extensions\auditTrail\behaviors\AuditTrailBehavior;

class Method extends MethodCommon
{
    public $moduleId = 'method';

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
                        'reportAsString',
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
