<?php

namespace nad\engineering\piping\stage\investigationMonitorMethods\report\models;

use nad\engineering\piping\stage\investigationMonitorMethods\report\models\Report;
use nad\engineering\piping\stage\investigationMonitorMethods\reference\models\Reference;
use nad\common\modules\investigation\report\models\ReportArchived as BaseReportArchived;

class ReportArchived extends BaseReportArchived
{
    const CONSUMER_CODE = Report::CONSUMER_CODE;

    public $moduleId = 'stage';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/stage/investigationMonitorMethods/report/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_report.consumer' => self::CONSUMER_CODE]);
    }
}
