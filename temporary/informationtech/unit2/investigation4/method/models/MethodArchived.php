<?php

namespace nad\temporary\informationtech\unit2\investigation4\method\models;

use nad\temporary\informationtech\unit2\investigation4\method\models\Method;
use nad\temporary\informationtech\unit2\investigation4\reference\models\Reference;
use nad\common\modules\investigation\method\models\MethodArchived as BaseMethodArchived;

class MethodArchived extends BaseMethodArchived
{
    const CONSUMER_CODE = Method::CONSUMER_CODE;

    public $moduleId = 'unit2';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/unit2/investigation4/method/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_method.consumer' => self::CONSUMER_CODE]);
    }
}
