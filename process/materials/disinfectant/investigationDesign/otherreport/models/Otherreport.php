<?php

namespace nad\process\materials\disinfectant\investigationDesign\otherreport\models;

use nad\process\materials\disinfectant\investigationDesign\otherreport\models\Otherreport;
use nad\process\materials\disinfectant\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\otherreport\models\Otherreport as BaseOtherreport;

class Otherreport extends BaseOtherreport
{
    const CONSUMER_CODE = Otherreport::class;

    public $moduleId = 'disinfectant';
    public $referenceClassName = Reference::class;

    // public function getProposal()
    // {
    //     return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    // }

    public function getBaseViewRoute()
    {
        return '/disinfectant/investigationDesign/otherreport/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_otherreport.consumer' => self::CONSUMER_CODE]);
    }
}