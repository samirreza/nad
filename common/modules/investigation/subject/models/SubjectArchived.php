<?php

namespace nad\common\modules\investigation\subject\models;

class SubjectArchived extends SubjectCommon
{
    public $moduleId = 'subject';

    public static function find()
    {
        return parent::find()->andWhere(['isArchived' => self::IS_SOURCE_ARCHIVED_YES]);
    }
}
