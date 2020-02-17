<?php

namespace nad\process\ird\introduction\investigation\subject\models;

use nad\process\ird\introduction\investigation\subject\models\Subject;
use nad\process\ird\introduction\investigation\reference\models\Reference;
use nad\common\modules\investigation\subject\models\Subject as BaseSubject;

class Subject extends BaseSubject
{
    const CONSUMER_CODE = Subject::class;

    public $moduleId = 'introduction';
    public $referenceClassName = Reference::class;

    // public function getProposal()
    // {
    //     return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    // }

    public function getBaseViewRoute()
    {
        return '/introduction/investigation/subject/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_subject.consumer' => self::CONSUMER_CODE]);
    }
}
