<?php

namespace nad\process\materials\colors\investigationDesign\source\models;

use nad\process\materials\colors\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = Source::class;

    public $moduleId = 'colors';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/colors/investigationDesign/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
