<?php

namespace nad\engineering\control\stage\models;

use nad\common\modules\engineering\stage\models\Stage as ParentStage;

class Stage extends ParentStage
{
    const CONSUMER_CODE = 'nad\engineering\control';

    public $moduleId = 'control';

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
