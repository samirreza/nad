<?php

namespace nad\engineering\control\device\investigationDesign\reference\models;

use nad\common\modules\investigation\reference\models\Reference as BaseReference;

class Reference extends BaseReference
{
    const CONSUMER_CODE = Reference::class;

    public $moduleId = 'device';

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
