<?php

namespace nad\seaport\wayside\unit1\investigation4\proposal\models;

use nad\seaport\wayside\unit1\investigation4\proposal\models\Proposal;
use nad\seaport\wayside\unit1\investigation4\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\ProposalArchived as BaseProposalArchived;

class ProposalArchived extends BaseProposalArchived
{
    const CONSUMER_CODE = Proposal::CONSUMER_CODE;

    public $moduleId = 'unit1';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/unit1/investigation4/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
