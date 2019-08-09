<?php

namespace nad\engineering\electricity\investigation\method\models;

use nad\engineering\electricity\investigation\reference\models\Reference;
use nad\common\modules\investigation\method\models\Method as BaseMethod;

class Method extends BaseMethod
{
    const CONSUMER_CODE = 'nad\engineering\electricity';

    public $moduleId = 'method';
    public $referenceClassName = Reference::class;

    public static function find()
    {
        return parent::find()->andWhere([
            'nad_investigation_method.consumer' => self::CONSUMER_CODE
        ]);
    }
}
