<?php

namespace nad\process\ird\newTechnology\investigation\proposal\models;

use nad\process\ird\newTechnology\investigation\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
{
    const CONSUMER_CODE = Proposal::class;

    public $moduleId= 'newTechnology';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/newTechnology/investigation/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
