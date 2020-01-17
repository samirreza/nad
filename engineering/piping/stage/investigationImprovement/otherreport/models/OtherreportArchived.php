<?php

namespace nad\engineering\piping\stage\investigationImprovement\otherreport\models;

use nad\engineering\piping\stage\investigationImprovement\otherreport\models\Otherreport;
use nad\engineering\piping\stage\investigationImprovement\reference\models\Reference;
use nad\common\modules\investigation\otherreport\models\OtherreportArchived as BaseOtherreportArchived;

class OtherreportArchived extends BaseOtherreportArchived
{
    const CONSUMER_CODE = Otherreport::CONSUMER_CODE;

    public $moduleId = 'stage';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/stage/investigationImprovement/otherreport/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_otherreport.consumer' => self::CONSUMER_CODE]);
    }
}
