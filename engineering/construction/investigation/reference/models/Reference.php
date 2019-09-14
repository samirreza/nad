<?php

namespace nad\engineering\construction\investigation\reference\models;

use nad\common\modules\investigation\reference\models\Reference as BaseReference;

class Reference extends BaseReference
{
    const CONSUMER_CODE = 'nad\engineering\construction';

    public $moduleId = 'construction';

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
