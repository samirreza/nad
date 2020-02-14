<?php

namespace nad\engineering\instrument\device\device\models;

use nad\common\modules\device\models\Device as ParentDevice;

class Device extends ParentDevice
{
    const CONSUMER_CODE = Device::class;

    public $moduleId = 'instrument';

    public function getBaseViewRoute()
    {
        return '/instrument/device/device/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
