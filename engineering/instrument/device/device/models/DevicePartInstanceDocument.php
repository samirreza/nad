<?php

namespace nad\engineering\instrument\device\device\models;

use nad\common\modules\device\models\DevicePartInstanceDocument as ParentDocument;

class DevicePartInstanceDocument extends ParentDocument
{
    const CONSUMER_CODE = DevicePartInstanceDocument::class;

    public $moduleId = 'instrument';

    public function getBaseViewRoute()
    {
        return '/instrument/device/device/device-part-instance-document/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
