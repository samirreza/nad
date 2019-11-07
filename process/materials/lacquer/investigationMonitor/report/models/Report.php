<?php

namespace nad\process\materials\lacquer\investigationMonitor\report\models;

use nad\process\materials\lacquer\investigationMonitor\proposal\models\Proposal;
use nad\process\materials\lacquer\investigationMonitor\reference\models\Reference;
use nad\common\modules\investigation\report\models\Report as BaseReport;

class Report extends BaseReport
{
    const CONSUMER_CODE = Report::class;

    public $moduleId = 'report';
    public $referenceClassName = Reference::class;

    public function getProposal()
    {
        return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_report.consumer' => self::CONSUMER_CODE]);
    }
}
