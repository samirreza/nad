<?php

namespace nad\engineering\instrument\location\models;

use nad\common\modules\engineering\location\models\Location as ParentLocation;

class Location extends ParentLocation
{
    const CONSUMER_CODE = 'nad\engineering\instrument';

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/instrument/location/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
