<?php

namespace nad\factory\build\unit3\investigation5\method\models;

use nad\factory\build\unit3\investigation5\method\models\Method;
use nad\factory\build\unit3\investigation5\reference\models\Reference;
use nad\common\modules\investigation\method\models\MethodArchived as BaseMethodArchived;

class MethodArchived extends BaseMethodArchived
{
    const CONSUMER_CODE = Method::CONSUMER_CODE;

    public $moduleId = 'unit3';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/unit3/investigation5/method/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_method.consumer' => self::CONSUMER_CODE]);
    }
}
