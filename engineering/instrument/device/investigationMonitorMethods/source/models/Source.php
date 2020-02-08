<?php

namespace nad\engineering\instrument\device\investigationMonitorMethods\source\models;

use nad\engineering\instrument\device\investigationMonitorMethods\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = Source::class;

    public $moduleId = 'device';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/device/investigationMonitorMethods/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
