<?php

namespace nad\process\ird\wastewater\investigationMonitor\source\models;

use nad\process\ird\wastewater\investigationMonitor\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = Source::class;

    public $moduleId = 'wastewater';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/wastewater/investigationMonitor/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
