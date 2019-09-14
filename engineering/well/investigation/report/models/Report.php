<?php

namespace nad\engineering\well\investigation\report\models;

use nad\engineering\well\investigation\proposal\models\Proposal;
use nad\engineering\well\investigation\reference\models\Reference;
use nad\common\modules\investigation\report\models\Report as BaseReport;

class Report extends BaseReport
{
    const CONSUMER_CODE = 'nad\engineering\well';

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
