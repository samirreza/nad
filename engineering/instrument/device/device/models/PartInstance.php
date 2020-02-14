<?php

namespace nad\engineering\instrument\device\device\models;

use nad\common\modules\device\models\PartInstance as ParentDevice;

class PartInstance extends ParentDevice
{
    const CONSUMER_CODE = PartInstance::class;

    public $moduleId = 'instrument';

    public function getBaseViewRoute()
    {
        return '/instrument/device/device/part-instance/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
