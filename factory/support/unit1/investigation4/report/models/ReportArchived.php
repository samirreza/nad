<?php

namespace nad\factory\support\unit1\investigation4\report\models;

use nad\factory\support\unit1\investigation4\report\models\Report;
use nad\factory\support\unit1\investigation4\reference\models\Reference;
use nad\common\modules\investigation\report\models\ReportArchived as BaseReportArchived;

class ReportArchived extends BaseReportArchived
{
    const CONSUMER_CODE = Report::CONSUMER_CODE;

    public $moduleId = 'unit1';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/unit1/investigation4/report/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_report.consumer' => self::CONSUMER_CODE]);
    }
}
