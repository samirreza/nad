<?php

namespace nad\engineering\electricity\stage\models;

use nad\common\modules\engineering\stage\models\Stage as ParentStage;

class Stage extends ParentStage
{
    const CONSUMER_CODE = 'nad\engineering\electricity';

    public $moduleId = 'electricity';

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
