<?php

namespace nad\process\materials\coagulant\investigationMonitor\reference\models;

use nad\common\modules\investigation\reference\models\Reference as BaseReference;

class Reference extends BaseReference
{
    const CONSUMER_CODE = Reference::class;

    public $moduleId = 'coagulant';

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_reference.consumer' => self::CONSUMER_CODE]);
    }
}
