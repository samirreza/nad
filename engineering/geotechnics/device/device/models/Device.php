<?php

namespace nad\engineering\geotechnics\device\device\models;

use nad\common\modules\device\models\Device as ParentDevice;

class Device extends ParentDevice
{
    const CONSUMER_CODE = Device::class;

    public $moduleId = 'geotechnics';

    public function getBaseViewRoute()
    {
        return '/geotechnics/device/device/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
