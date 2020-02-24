<?php

namespace nad\factory\production\unit4\investigation2\report\models;

use nad\factory\production\unit4\investigation2\report\models\Report;
use nad\factory\production\unit4\investigation2\reference\models\Reference;
use nad\common\modules\investigation\report\models\ReportArchived as BaseReportArchived;

class ReportArchived extends BaseReportArchived
{
    const CONSUMER_CODE = Report::CONSUMER_CODE;

    public $moduleId = 'unit4';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/unit4/investigation2/report/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_report.consumer' => self::CONSUMER_CODE]);
    }
}
