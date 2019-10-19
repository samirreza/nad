<?php

namespace nad\common\modules\investigation\proposal\models;

class ProposalArchived extends ProposalCommon
{
    public $moduleId = 'proposal';

    public static function find()
    {
        return parent::find()->andWhere(['isArchived' => self::IS_SOURCE_ARCHIVED_YES]);
    }
}
