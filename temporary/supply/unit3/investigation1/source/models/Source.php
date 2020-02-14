<?php

namespace nad\temporary\supply\unit3\investigation1\source\models;

use nad\temporary\supply\unit3\investigation1\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = Source::class;

    public $moduleId = 'unit3';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/unit3/investigation1/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
