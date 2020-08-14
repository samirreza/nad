<?php

namespace nad\engineering\piping\stage\investigation4\proposal\models;

use nad\engineering\piping\stage\investigation4\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
{
    const CONSUMER_CODE = Proposal::class;

    public $moduleId= 'stage';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/stage/investigation4/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
