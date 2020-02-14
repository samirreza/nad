<?php

namespace nad\engineering\control\device\device\models;

use nad\common\modules\device\models\DeviceInstance as ParentDevice;

class DeviceInstance extends ParentDevice
{
    const CONSUMER_CODE = DeviceInstance::class;

    public $moduleId = 'control';

    public function getBaseViewRoute()
    {
        return '/control/device/device/device-instance/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([parent::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
