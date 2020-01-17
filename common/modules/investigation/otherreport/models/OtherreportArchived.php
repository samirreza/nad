<?php

namespace nad\common\modules\investigation\otherreport\models;

class OtherreportArchived extends OtherreportCommon
{
    public $moduleId = 'otherreport';

    public static function find()
    {
        return parent::find()->andWhere(['isArchived' => self::IS_SOURCE_ARCHIVED_YES]);
    }
}
