<?php

namespace nad\engineering\piping\investigation\method\models;

use nad\engineering\piping\investigation\reference\models\Reference;
use nad\common\modules\investigation\method\models\Method as BaseMethod;

class Method extends BaseMethod
{
    const CONSUMER_CODE = 'nad\engineering\piping';

    public $moduleId = 'method';
    public $referenceClassName = Reference::class;

    public static function find()
    {
        return parent::find()->andWhere([
            'nad_investigation_method.consumer' => self::CONSUMER_CODE
        ]);
    }
}
