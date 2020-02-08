<?php

namespace nad\process\ird\heattransfer\investigation\proposal\models;

use nad\process\ird\heattransfer\investigation\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
{
    const CONSUMER_CODE = Proposal::class;

    public $moduleId= 'heattransfer';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/heattransfer/investigation/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
