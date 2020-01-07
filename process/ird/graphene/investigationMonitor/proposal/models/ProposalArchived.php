<?php

namespace nad\process\ird\graphene\investigationMonitor\proposal\models;

use nad\process\ird\graphene\investigationMonitor\proposal\models\Proposal;
use nad\process\ird\graphene\investigationMonitor\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\ProposalArchived as BaseProposalArchived;

class ProposalArchived extends BaseProposalArchived
{
    const CONSUMER_CODE = Proposal::CONSUMER_CODE;

    public $moduleId = 'graphene';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/graphene/investigationMonitor/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
