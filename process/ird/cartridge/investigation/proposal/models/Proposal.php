<?php

namespace nad\process\ird\cartridge\investigation\proposal\models;

use nad\process\ird\cartridge\investigation\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
{
    const CONSUMER_CODE = Proposal::class;

    public $moduleId= 'cartridge';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/cartridge/investigation/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
