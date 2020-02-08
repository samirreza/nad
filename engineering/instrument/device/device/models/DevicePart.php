<?php

namespace nad\engineering\instrument\device\device\models;

use nad\common\modules\device\models\DevicePart as ParentDevice;

class DevicePart extends ParentDevice
{
    // const CONSUMER_CODE = Device::class;

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/instrument/device/device/device-part/view';
    }

    // public static function find()
    // {
    //     return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    // }
}
