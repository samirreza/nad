<?php

namespace nad\process\ird\wastewater\investigationMonitor\proposal\models;

use nad\process\ird\wastewater\investigationMonitor\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
{
    const CONSUMER_CODE = Proposal::class;

    public $moduleId= 'wastewater';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/wastewater/investigationMonitor/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}