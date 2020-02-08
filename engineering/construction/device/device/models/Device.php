<?php

namespace nad\engineering\construction\device\device\models;

use nad\common\modules\device\models\Device as ParentDevice;

class Device extends ParentDevice
{
    // const CONSUMER_CODE = Device::class;

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/construction/device/device/manage/view';
    }

    // public static function find()
    // {
    //     return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    // }
}
