<?php

namespace nad\process\ird\pool\investigation\report\models;

use nad\process\ird\pool\investigation\reference\models\Reference;
use nad\common\modules\investigation\report\models\Report as BaseReport;

class Report extends BaseReport
{
    const CONSUMER_CODE = 'SD';

    public $moduleId = 'report';
    public $referenceClassName = Reference::class;

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_report.consumer' => self::CONSUMER_CODE]);
    }
}
