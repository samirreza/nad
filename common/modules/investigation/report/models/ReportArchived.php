<?php

namespace nad\common\modules\investigation\report\models;

class ReportArchived extends ReportCommon
{
    public $moduleId = 'report';

    public static function find()
    {
        return parent::find()->andWhere(['isArchived' => self::IS_SOURCE_ARCHIVED_YES]);
    }
}
