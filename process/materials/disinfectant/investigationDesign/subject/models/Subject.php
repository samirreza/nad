<?php

namespace nad\process\materials\disinfectant\investigationDesign\subject\models;

use nad\process\materials\disinfectant\investigationDesign\subject\models\Subject;
use nad\process\materials\disinfectant\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\subject\models\Subject as BaseSubject;

class Subject extends BaseSubject
{
    const CONSUMER_CODE = Subject::class;

    public $moduleId = 'disinfectant';
    public $referenceClassName = Reference::class;

    // public function getProposal()
    // {
    //     return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    // }

    public function getBaseViewRoute()
    {
        return '/disinfectant/investigationDesign/subject/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_subject.consumer' => self::CONSUMER_CODE]);
    }
}
