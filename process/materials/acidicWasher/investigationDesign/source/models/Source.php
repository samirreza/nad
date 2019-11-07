<?php

namespace nad\process\materials\acidicWasher\investigationDesign\source\models;

use nad\process\materials\acidicWasher\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = Source::class;

    public $moduleId = 'acidicWasher';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/acidicWasher/investigationDesign/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
