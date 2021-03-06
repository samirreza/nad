<?php

namespace nad\factory\production\unit5\investigation1\proposal\models;

use nad\factory\production\unit5\investigation1\proposal\models\Proposal;
use nad\factory\production\unit5\investigation1\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\ProposalArchived as BaseProposalArchived;

class ProposalArchived extends BaseProposalArchived
{
    const CONSUMER_CODE = Proposal::CONSUMER_CODE;

    public $moduleId = 'unit5';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/unit5/investigation1/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
