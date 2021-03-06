<?php

namespace nad\engineering\control\device\device\models;

use nad\common\modules\device\models\DevicePart as ParentDevice;

class DevicePart extends ParentDevice
{
    const CONSUMER_CODE = DevicePart::class;

    public $moduleId = 'control';

    public function getBaseViewRoute()
    {
        return '/control/device/device/device-part/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([parent::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
