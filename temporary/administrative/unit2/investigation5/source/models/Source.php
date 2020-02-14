<?php

namespace nad\temporary\administrative\unit2\investigation5\source\models;

use nad\temporary\administrative\unit2\investigation5\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = Source::class;

    public $moduleId = 'unit2';
    public $referenceClassName = Reference::class;

    public function getBaseViewRoute()
    {
        return '/unit2/investigation5/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
