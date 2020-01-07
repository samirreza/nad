<?php

namespace nad\process\ird\newTechnology\investigationDesign\proposal\models;

use nad\process\ird\newTechnology\investigationDesign\proposal\models\Proposal;
use nad\process\ird\newTechnology\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\ProposalArchived as BaseProposalArchived;

class ProposalArchived extends BaseProposalArchived
{
    const CONSUMER_CODE = Proposal::CONSUMER_CODE;

    public $moduleId = 'newTechnology';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/newTechnology/investigationDesign/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
