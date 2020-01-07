<?php

namespace nad\process\ird\cartridge\investigationDesign\proposal\models;

use nad\process\ird\cartridge\investigationDesign\proposal\models\Proposal;
use nad\process\ird\cartridge\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\ProposalArchived as BaseProposalArchived;

class ProposalArchived extends BaseProposalArchived
{
    const CONSUMER_CODE = Proposal::CONSUMER_CODE;

    public $moduleId = 'cartridge';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/cartridge/investigationDesign/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
