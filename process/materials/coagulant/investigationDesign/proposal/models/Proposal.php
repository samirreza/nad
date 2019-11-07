<?php

namespace nad\process\materials\coagulant\investigationDesign\proposal\models;

use nad\process\materials\coagulant\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
{
    const CONSUMER_CODE = Proposal::class;

    public $moduleId= 'coagulant';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/coagulant/investigationDesign/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_proposal.consumer' => self::CONSUMER_CODE]);
    }
}
