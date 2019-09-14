<?php

namespace nad\engineering\mechanics\investigation\report\models;

use nad\engineering\mechanics\investigation\proposal\models\Proposal;
use nad\engineering\mechanics\investigation\reference\models\Reference;
use nad\common\modules\investigation\report\models\Report as BaseReport;

class Report extends BaseReport
{
    const CONSUMER_CODE = 'nad\engineering\mechanics';

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
