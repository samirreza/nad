<?php

namespace nad\process\ird\introduction\investigation\proposal\models;

use nad\process\ird\introduction\investigation\proposal\models\Proposal;
use nad\process\ird\introduction\investigation\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\ProposalArchived as BaseProposalArchived;

class ProposalArchived extends BaseProposalArchived
{
    const CONSUMER_CODE = Proposal::CONSUMER_CODE;

    public $moduleId = 'introduction';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/introduction/investigation/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
