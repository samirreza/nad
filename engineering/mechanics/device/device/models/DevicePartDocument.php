<?php

namespace nad\engineering\mechanics\device\device\models;

use nad\common\modules\device\models\DevicePartDocument as ParentDocument;

class DevicePartDocument extends ParentDocument
{
    const CONSUMER_CODE = DevicePartDocument::class;

    public $moduleId = 'mechanics';

    public function getBaseViewRoute()
    {
        return '/mechanics/device/device/device-part-document/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
