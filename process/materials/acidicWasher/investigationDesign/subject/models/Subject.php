<?php

namespace nad\process\materials\acidicWasher\investigationDesign\subject\models;

use nad\process\materials\acidicWasher\investigationDesign\subject\models\Subject;
use nad\process\materials\acidicWasher\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\subject\models\Subject as BaseSubject;

class Subject extends BaseSubject
{
    const CONSUMER_CODE = Subject::class;

    public $moduleId = 'acidicWasher';
    public $referenceClassName = Reference::class;

    // public function getProposal()
    // {
    //     return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    // }

    public function getBaseViewRoute()
    {
        return '/acidicWasher/investigationDesign/subject/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_subject.consumer' => self::CONSUMER_CODE]);
    }
}
