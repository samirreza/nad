<?php

namespace nad\engineering\construction\device\investigationDesign\method\models;

use nad\engineering\construction\device\investigationDesign\method\models\Method;
use nad\engineering\construction\device\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\method\models\MethodArchived as BaseMethodArchived;

class MethodArchived extends BaseMethodArchived
{
    const CONSUMER_CODE = Method::CONSUMER_CODE;

    public $moduleId = 'device';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/device/investigationDesign/method/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_method.consumer' => self::CONSUMER_CODE]);
    }
}
