<?php

namespace nad\process\materials\acidicWasher\investigationDesign\subject\models;

use nad\process\materials\acidicWasher\investigationDesign\subject\models\Subject;
use nad\process\materials\acidicWasher\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\subject\models\SubjectArchived as BaseSubjectArchived;

class SubjectArchived extends BaseSubjectArchived
{
    const CONSUMER_CODE = Subject::CONSUMER_CODE;

    public $moduleId = 'acidicWasher';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/acidicWasher/investigationDesign/subject/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_subject.consumer' => self::CONSUMER_CODE]);
    }
}
