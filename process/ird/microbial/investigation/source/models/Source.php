<?php

namespace nad\process\ird\microbial\investigation\source\models;

use nad\process\ird\microbial\investigation\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = Source::class;

    public $moduleId = 'microbial';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/microbial/investigation/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
