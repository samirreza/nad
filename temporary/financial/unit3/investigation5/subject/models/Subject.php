<?php

namespace nad\temporary\financial\unit3\investigation5\subject\models;

use nad\temporary\financial\unit3\investigation5\subject\models\Subject;
use nad\temporary\financial\unit3\investigation5\reference\models\Reference;
use nad\common\modules\investigation\subject\models\Subject as BaseSubject;

class Subject extends BaseSubject
{
    const CONSUMER_CODE = Subject::class;

    public $moduleId = 'unit3';
    public $referenceClassName = Reference::class;

    // public function getProposal()
    // {
    //     return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    // }

    public function getBaseViewRoute()
    {
        return '/unit3/investigation5/subject/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_subject.consumer' => self::CONSUMER_CODE]);
    }
}
