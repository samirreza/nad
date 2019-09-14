<?php

namespace nad\process\ird\graphene\investigation\reference\models;

use nad\common\modules\investigation\reference\models\Reference as BaseReference;

class Reference extends BaseReference
{
    const CONSUMER_CODE = 'GR';

    public $moduleId = 'graphene';

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
