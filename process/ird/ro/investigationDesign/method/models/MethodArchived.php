<?php

namespace nad\process\ird\ro\investigationDesign\method\models;

use nad\process\ird\ro\investigationDesign\method\models\Method;
use nad\process\ird\ro\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\method\models\MethodArchived as BaseMethodArchived;

class MethodArchived extends BaseMethodArchived
{
    const CONSUMER_CODE = Method::CONSUMER_CODE;

    public $moduleId = 'ro';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/ro/investigationDesign/method/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_method.consumer' => self::CONSUMER_CODE]);
    }
}
