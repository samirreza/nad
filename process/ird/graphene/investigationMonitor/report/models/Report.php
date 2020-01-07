<?php

namespace nad\process\ird\graphene\investigationMonitor\report\models;

use nad\process\ird\graphene\investigationMonitor\report\models\Report;
use nad\process\ird\graphene\investigationMonitor\reference\models\Reference;
use nad\common\modules\investigation\report\models\Report as BaseReport;

class Report extends BaseReport
{
    const CONSUMER_CODE = Report::class;

    public $moduleId = 'graphene';
    public $referenceClassName = Reference::class;

    // public function getProposal()
    // {
    //     return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    // }

    public function getBaseViewRoute()
    {
        return '/graphene/investigationMonitor/report/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_report.consumer' => self::CONSUMER_CODE]);
    }
}
