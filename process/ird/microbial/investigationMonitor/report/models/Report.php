<?php

namespace nad\process\ird\microbial\investigationMonitor\report\models;

use nad\process\ird\microbial\investigationMonitor\report\models\Report;
use nad\process\ird\microbial\investigationMonitor\reference\models\Reference;
use nad\common\modules\investigation\report\models\Report as BaseReport;

class Report extends BaseReport
{
    const CONSUMER_CODE = Report::class;

    public $moduleId = 'microbial';
    public $referenceClassName = Reference::class;

    // public function getProposal()
    // {
    //     return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    // }

    public function getBaseViewRoute()
    {
        return '/microbial/investigationMonitor/report/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_report.consumer' => self::CONSUMER_CODE]);
    }
}
