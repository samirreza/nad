<?php

namespace nad\engineering\construction\stage\models;

use nad\common\modules\engineering\stage\models\Stage as ParentStage;

class Stage extends ParentStage
{
    const CONSUMER_CODE = 'nad\engineering\construction';

    public $moduleId = 'construction';

    public static function find()
    {    	
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
