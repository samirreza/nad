<?php

namespace nad\engineering\piping\device\device\models;

use nad\common\modules\device\models\DeviceInstance as ParentDevice;

class DeviceInstance extends ParentDevice
{
    const CONSUMER_CODE = DeviceInstance::class;

    public $moduleId = 'piping';

    public function getBaseViewRoute()
    {
        return '/piping/device/device/device-instance/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
