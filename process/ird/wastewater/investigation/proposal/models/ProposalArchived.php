<?php

namespace nad\process\ird\wastewater\investigation\proposal\models;

use nad\process\ird\wastewater\investigation\proposal\models\Proposal;
use nad\process\ird\wastewater\investigation\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\ProposalArchived as BaseProposalArchived;

class ProposalArchived extends BaseProposalArchived
{
    const CONSUMER_CODE = Proposal::CONSUMER_CODE;

    public $moduleId = 'wastewater';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/wastewater/investigation/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
