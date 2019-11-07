<?php

namespace nad\process\materials\disinfectant\investigationDesign\proposal\models;

use nad\process\materials\disinfectant\investigationDesign\proposal\models\Proposal;
use nad\process\materials\disinfectant\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\ProposalArchived as BaseProposalArchived;

class ProposalArchived extends BaseProposalArchived
{
    const CONSUMER_CODE = Proposal::CONSUMER_CODE;

    public $moduleId = 'disinfectant';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/disinfectant/investigationDesign/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
