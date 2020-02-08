<?php

namespace nad\engineering\control\stage\investigationMonitorMethods\method\models;

use nad\engineering\control\stage\investigationMonitorMethods\method\models\Method;
use nad\engineering\control\stage\investigationMonitorMethods\reference\models\Reference;
use nad\common\modules\investigation\method\models\MethodArchived as BaseMethodArchived;

class MethodArchived extends BaseMethodArchived
{
    const CONSUMER_CODE = Method::CONSUMER_CODE;

    public $moduleId = 'stage';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/stage/investigationMonitorMethods/method/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_method.consumer' => self::CONSUMER_CODE]);
    }
}
