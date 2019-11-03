<?php

namespace nad\common\modules\investigation\method\models;

class MethodArchived extends MethodCommon
{
    public $moduleId = 'method';

    public static function find()
    {
        return parent::find()->andWhere(['isArchived' => self::IS_SOURCE_ARCHIVED_YES]);
    }
}
