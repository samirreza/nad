<?php

namespace nad\process\materials\lacquer\investigationDesign\method\models;

use nad\process\materials\lacquer\investigationDesign\method\models\Method;
use nad\process\materials\lacquer\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\method\models\MethodArchived as BaseMethodArchived;

class MethodArchived extends BaseMethodArchived
{
    const CONSUMER_CODE = Method::CONSUMER_CODE;

    public $moduleId = 'lacquer';
    public $referenceClassName = Reference::class;


    public function getBaseViewRoute()
    {
        return '/lacquer/investigationDesign/method/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_method.consumer' => self::CONSUMER_CODE]);
    }
}
