<?php

namespace nad\engineering\control\device\device\models;

use nad\common\modules\device\models\DeviceInstance as ParentDevice;

class DeviceInstance extends ParentDevice
{
    // const CONSUMER_CODE = Device::class;

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/control/device/device/device-instance/view';
    }

    // public static function find()
    // {
    //     return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    // }
}
