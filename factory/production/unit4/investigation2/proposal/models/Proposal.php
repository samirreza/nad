<?php

namespace nad\factory\production\unit4\investigation2\proposal\models;

use nad\factory\production\unit4\investigation2\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
{
    const CONSUMER_CODE = Proposal::class;

    public $moduleId= 'unit4';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/unit4/investigation2/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
