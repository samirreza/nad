<?php

namespace nad\engineering\mechanics\device\device\models;

use nad\common\modules\device\models\DevicePartInstanceDocument as ParentDocument;

class DevicePartInstanceDocument extends ParentDocument
{
    const CONSUMER_CODE = DevicePartInstanceDocument::class;

    public $moduleId = 'mechanics';

    public function getBaseViewRoute()
    {
        return '/mechanics/device/device/device-part-instance-document/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
