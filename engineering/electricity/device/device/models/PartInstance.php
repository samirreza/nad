<?php

namespace nad\engineering\electricity\device\device\models;

use nad\common\modules\device\models\PartInstance as ParentDevice;

class PartInstance extends ParentDevice
{
    // const CONSUMER_CODE = Device::class;

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/electricity/device/device/part-instance/view';
    }

    // public static function find()
    // {
    //     return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    // }
}
