<?php

namespace nad\process\ird\pool\investigation\reference\models;

use nad\common\modules\investigation\reference\models\Reference as BaseReference;

class Reference extends BaseReference
{
    const CONSUMER_CODE = 'SD';

    public $moduleId = 'pool';

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
