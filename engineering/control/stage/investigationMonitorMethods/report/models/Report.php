<?php

namespace nad\engineering\control\stage\investigationMonitorMethods\report\models;

use nad\engineering\control\stage\investigationMonitorMethods\report\models\Report;
use nad\engineering\control\stage\investigationMonitorMethods\reference\models\Reference;
use nad\common\modules\investigation\report\models\Report as BaseReport;

class Report extends BaseReport
{
    const CONSUMER_CODE = Report::class;

    public $moduleId = 'stage';
    public $referenceClassName = Reference::class;

    // public function getProposal()
    // {
    //     return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    // }

    public function getBaseViewRoute()
    {
        return '/stage/investigationMonitorMethods/report/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_report.consumer' => self::CONSUMER_CODE]);
    }
}
