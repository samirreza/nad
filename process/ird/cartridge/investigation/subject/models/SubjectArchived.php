<?php

namespace nad\process\ird\cartridge\investigation\subject\models;

use nad\process\ird\cartridge\investigation\subject\models\Subject;
use nad\process\ird\cartridge\investigation\reference\models\Reference;
use nad\common\modules\investigation\subject\models\SubjectArchived as BaseSubjectArchived;

class SubjectArchived extends BaseSubjectArchived
{
    const CONSUMER_CODE = Subject::CONSUMER_CODE;

    public $moduleId = 'cartridge';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/cartridge/investigation/subject/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_subject.consumer' => self::CONSUMER_CODE]);
    }
}
