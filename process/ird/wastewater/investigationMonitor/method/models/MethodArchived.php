<?php

namespace nad\process\ird\wastewater\investigationMonitor\method\models;

use nad\process\ird\wastewater\investigationMonitor\method\models\Method;
use nad\process\ird\wastewater\investigationMonitor\reference\models\Reference;
use nad\common\modules\investigation\method\models\MethodArchived as BaseMethodArchived;

class MethodArchived extends BaseMethodArchived
{
    const CONSUMER_CODE = Method::CONSUMER_CODE;

    public $moduleId = 'wastewater';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/wastewater/investigationMonitor/method/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_method.consumer' => self::CONSUMER_CODE]);
    }
}
