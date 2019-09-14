<?php

namespace nad\engineering\instrument\investigation\reference\models;

use nad\common\modules\investigation\reference\models\Reference as BaseReference;

class Reference extends BaseReference
{
    const CONSUMER_CODE = 'nad\engineering\instrument';

    public $moduleId = 'instrument';

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
