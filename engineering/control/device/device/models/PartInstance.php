<?php

namespace nad\engineering\control\device\device\models;

use nad\common\modules\device\models\PartInstance as ParentDevice;

class PartInstance extends ParentDevice
{
    const CONSUMER_CODE = PartInstance::class;

    public $moduleId = 'control';

    public function getBaseViewRoute()
    {
        return '/control/device/device/part-instance/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([parent::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
