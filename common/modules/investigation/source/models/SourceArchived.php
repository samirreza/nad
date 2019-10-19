<?php

namespace nad\common\modules\investigation\source\models;

class SourceArchived extends SourceCommon
{
    public $moduleId = 'source';

    public static function find()
    {
        return parent::find()->andWhere(['isArchived' => self::IS_SOURCE_ARCHIVED_YES]);
    }
}
