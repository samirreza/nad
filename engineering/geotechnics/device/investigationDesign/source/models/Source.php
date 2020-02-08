<?php

namespace nad\engineering\geotechnics\device\investigationDesign\source\models;

use nad\engineering\geotechnics\device\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = Source::class;

    public $moduleId = 'device';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/device/investigationDesign/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
