<?php

namespace nad\process\materials\coagulant\investigationDesign\subject\models;

use nad\process\materials\coagulant\investigationDesign\subject\models\Subject;
use nad\process\materials\coagulant\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\subject\models\SubjectArchived as BaseSubjectArchived;

class SubjectArchived extends BaseSubjectArchived
{
    const CONSUMER_CODE = Subject::CONSUMER_CODE;

    public $moduleId = 'coagulant';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/coagulant/investigationDesign/subject/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_subject.consumer' => self::CONSUMER_CODE]);
    }
}
