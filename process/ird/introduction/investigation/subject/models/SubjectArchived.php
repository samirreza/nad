<?php

namespace nad\process\ird\introduction\investigation\subject\models;

use nad\process\ird\introduction\investigation\subject\models\Subject;
use nad\process\ird\introduction\investigation\reference\models\Reference;
use nad\common\modules\investigation\subject\models\SubjectArchived as BaseSubjectArchived;

class SubjectArchived extends BaseSubjectArchived
{
    const CONSUMER_CODE = Subject::CONSUMER_CODE;

    public $moduleId = 'introduction';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/introduction/investigation/subject/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_subject.consumer' => self::CONSUMER_CODE]);
    }
}
