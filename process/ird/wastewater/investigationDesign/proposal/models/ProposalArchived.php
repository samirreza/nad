<?php

namespace nad\process\ird\wastewater\investigationDesign\proposal\models;

use nad\process\ird\wastewater\investigationDesign\proposal\models\Proposal;
use nad\process\ird\wastewater\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\ProposalArchived as BaseProposalArchived;

class ProposalArchived extends BaseProposalArchived
{
    const CONSUMER_CODE = Proposal::CONSUMER_CODE;

    public $moduleId = 'wastewater';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/wastewater/investigationDesign/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
