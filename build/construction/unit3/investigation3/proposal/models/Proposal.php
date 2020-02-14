<?php

namespace nad\build\construction\unit3\investigation3\proposal\models;

use nad\build\construction\unit3\investigation3\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
{
    const CONSUMER_CODE = Proposal::class;

    public $moduleId= 'unit3';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/unit3/investigation3/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
