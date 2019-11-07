<?php

namespace nad\process\ird\sedimentation\investigation\proposal\models;

use nad\process\ird\sedimentation\investigation\proposal\models\Proposal;
use nad\process\ird\sedimentation\investigation\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\ProposalArchived as BaseProposalArchived;

class ProposalArchived extends BaseProposalArchived
{
    const CONSUMER_CODE = Proposal::CONSUMER_CODE;

    public $moduleId = 'sedimentation';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/sedimentation/investigation/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
