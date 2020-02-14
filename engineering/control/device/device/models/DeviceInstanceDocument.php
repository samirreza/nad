<?php

namespace nad\engineering\control\device\device\models;

use nad\common\modules\device\models\DeviceInstanceDocument as ParentDocument;

class DeviceInstanceDocument extends ParentDocument
{
    const CONSUMER_CODE = DeviceInstanceDocument::class;

    public $moduleId = 'control';

    public function getBaseViewRoute()
    {
        return '/control/device/device/device-instance-document/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([parent::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
