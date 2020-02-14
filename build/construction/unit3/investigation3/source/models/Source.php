<?php

namespace nad\build\construction\unit3\investigation3\source\models;

use nad\build\construction\unit3\investigation3\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = Source::class;

    public $moduleId = 'unit3';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/unit3/investigation3/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
