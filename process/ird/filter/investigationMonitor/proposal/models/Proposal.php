<?php

namespace nad\process\ird\filter\investigationMonitor\proposal\models;

use nad\process\ird\filter\investigationMonitor\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
{
    const CONSUMER_CODE = Proposal::class;

    public $moduleId= 'filter';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/filter/investigationMonitor/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
