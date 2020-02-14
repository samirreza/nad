<?php

namespace nad\engineering\electricity\device\device\models;

use nad\common\modules\device\models\DevicePartInstanceDocument as ParentDocument;

class DevicePartInstanceDocument extends ParentDocument
{
    const CONSUMER_CODE = DevicePartInstanceDocument::class;

    public $moduleId = 'electricity';

    public function getBaseViewRoute()
    {
        return '/electricity/device/device/device-part-instance-document/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
