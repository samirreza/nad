<?php

namespace nad\engineering\control\location\models;

use nad\common\modules\engineering\location\models\Location as ParentLocation;

class Location extends ParentLocation
{
    const CONSUMER_CODE = 'nad\engineering\control';

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/control/location/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
