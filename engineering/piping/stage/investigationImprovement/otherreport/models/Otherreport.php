<?php

namespace nad\engineering\piping\stage\investigationImprovement\otherreport\models;

use nad\engineering\piping\stage\investigationImprovement\otherreport\models\Otherreport;
use nad\engineering\piping\stage\investigationImprovement\reference\models\Reference;
use nad\common\modules\investigation\otherreport\models\Otherreport as BaseOtherreport;

class Otherreport extends BaseOtherreport
{
    const CONSUMER_CODE = Otherreport::class;

    public $moduleId = 'stage';
    public $referenceClassName = Reference::class;

    // public function getProposal()
    // {
    //     return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    // }

    public function getBaseViewRoute()
    {
        return '/stage/investigationImprovement/otherreport/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_otherreport.consumer' => self::CONSUMER_CODE]);
    }
}
