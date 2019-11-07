<?php

namespace nad\process\ird\sedimentation\investigation\method\models;

use nad\process\ird\sedimentation\investigation\method\models\Method;
use nad\process\ird\sedimentation\investigation\reference\models\Reference;
use nad\common\modules\investigation\method\models\MethodArchived as BaseMethodArchived;

class MethodArchived extends BaseMethodArchived
{
    const CONSUMER_CODE = Method::CONSUMER_CODE;

    public $moduleId = 'sedimentation';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/sedimentation/investigation/method/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_method.consumer' => self::CONSUMER_CODE]);
    }
}
