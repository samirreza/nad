<?php

namespace nad\process\materials\disinfectant\investigationDesign\subject\models;

use nad\process\materials\disinfectant\investigationDesign\subject\models\Subject;
use nad\process\materials\disinfectant\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\subject\models\SubjectArchived as BaseSubjectArchived;

class SubjectArchived extends BaseSubjectArchived
{
    const CONSUMER_CODE = Subject::CONSUMER_CODE;

    public $moduleId = 'disinfectant';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/disinfectant/investigationDesign/subject/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_subject.consumer' => self::CONSUMER_CODE]);
    }
}
