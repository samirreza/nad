<?php

namespace nad\common\modules\investigation\proposal\models;

use extensions\file\behaviors\FileBehavior;
use extensions\auditTrail\behaviors\AuditTrailBehavior;

class Proposal extends ProposalCommon
{
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
                        'reportExpertAsString',
                        'sourceAsString',
                        'reportAsString'
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
