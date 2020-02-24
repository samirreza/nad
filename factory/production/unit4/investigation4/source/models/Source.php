<?php

namespace nad\factory\production\unit4\investigation4\source\models;

use nad\factory\production\unit4\investigation4\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = Source::class;

    public $moduleId = 'unit4';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/unit4/investigation4/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
