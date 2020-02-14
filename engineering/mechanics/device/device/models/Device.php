<?php

namespace nad\engineering\mechanics\device\device\models;

use nad\common\modules\device\models\Device as ParentDevice;

class Device extends ParentDevice
{
    const CONSUMER_CODE = Device::class;

    public $moduleId = 'mechanics';

    public function getBaseViewRoute()
    {
        return '/mechanics/device/device/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
