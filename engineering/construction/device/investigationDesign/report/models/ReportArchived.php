<?php

namespace nad\engineering\construction\device\investigationDesign\report\models;

use nad\engineering\construction\device\investigationDesign\report\models\Report;
use nad\engineering\construction\device\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\report\models\ReportArchived as BaseReportArchived;

class ReportArchived extends BaseReportArchived
{
    const CONSUMER_CODE = Report::CONSUMER_CODE;

    public $moduleId = 'device';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/device/investigationDesign/report/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_report.consumer' => self::CONSUMER_CODE]);
    }
}
