<?php

namespace nad\engineering\electricity\stage\investigationMonitorMethods\source\models;

use nad\engineering\electricity\stage\investigationMonitorMethods\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = Source::class;

    public $moduleId = 'stage';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/stage/investigationMonitorMethods/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
