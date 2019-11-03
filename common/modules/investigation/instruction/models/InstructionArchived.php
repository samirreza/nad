<?php

namespace nad\common\modules\investigation\instruction\models;

class InstructionArchived extends InstructionCommon
{
    public $moduleId = 'instruction';

    public static function find()
    {
        return parent::find()->andWhere(['isArchived' => self::IS_SOURCE_ARCHIVED_YES]);
    }
}
