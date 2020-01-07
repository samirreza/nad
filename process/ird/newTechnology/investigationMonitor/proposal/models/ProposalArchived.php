<?php

namespace nad\process\ird\newTechnology\investigationMonitor\proposal\models;

use nad\process\ird\newTechnology\investigationMonitor\proposal\models\Proposal;
use nad\process\ird\newTechnology\investigationMonitor\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\ProposalArchived as BaseProposalArchived;

class ProposalArchived extends BaseProposalArchived
{
    const CONSUMER_CODE = Proposal::CONSUMER_CODE;

    public $moduleId = 'newTechnology';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/newTechnology/investigationMonitor/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
