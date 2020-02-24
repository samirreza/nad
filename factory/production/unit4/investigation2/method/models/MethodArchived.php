<?php

namespace nad\factory\production\unit4\investigation2\method\models;

use nad\factory\production\unit4\investigation2\method\models\Method;
use nad\factory\production\unit4\investigation2\reference\models\Reference;
use nad\common\modules\investigation\method\models\MethodArchived as BaseMethodArchived;

class MethodArchived extends BaseMethodArchived
{
    const CONSUMER_CODE = Method::CONSUMER_CODE;

    public $moduleId = 'unit4';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/unit4/investigation2/method/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_method.consumer' => self::CONSUMER_CODE]);
    }
}
