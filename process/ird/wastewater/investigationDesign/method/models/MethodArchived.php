<?php

namespace nad\process\ird\wastewater\investigationDesign\method\models;

use nad\process\ird\wastewater\investigationDesign\method\models\Method;
use nad\process\ird\wastewater\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\method\models\MethodArchived as BaseMethodArchived;

class MethodArchived extends BaseMethodArchived
{
    const CONSUMER_CODE = Method::CONSUMER_CODE;

    public $moduleId = 'wastewater';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/wastewater/investigationDesign/method/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_method.consumer' => self::CONSUMER_CODE]);
    }
}
