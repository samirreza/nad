<?php

namespace nad\engineering\mechanics\device\device\models;

use nad\common\modules\device\models\DevicePart as ParentDevice;

class DevicePart extends ParentDevice
{
    const CONSUMER_CODE = DevicePart::class;

    public $moduleId = 'mechanics';

    public function getBaseViewRoute()
    {
        return '/mechanics/device/device/device-part/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
