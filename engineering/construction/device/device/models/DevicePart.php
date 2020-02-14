<?php

namespace nad\engineering\construction\device\device\models;

use nad\common\modules\device\models\DevicePart as ParentDevice;

class DevicePart extends ParentDevice
{
    const CONSUMER_CODE = DevicePart::class;

    public $moduleId = 'construction';

    public function getBaseViewRoute()
    {
        return '/construction/device/device/device-part/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
