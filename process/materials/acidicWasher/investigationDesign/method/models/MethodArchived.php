<?php

namespace nad\process\materials\acidicWasher\investigationDesign\method\models;

use nad\process\materials\acidicWasher\investigationDesign\method\models\Method;
use nad\process\materials\acidicWasher\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\method\models\MethodArchived as BaseMethodArchived;

class MethodArchived extends BaseMethodArchived
{
    const CONSUMER_CODE = Method::CONSUMER_CODE;

    public $moduleId = 'acidicWasher';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/acidicWasher/investigationDesign/method/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_method.consumer' => self::CONSUMER_CODE]);
    }
}
