<?php

namespace nad\engineering\mechanics\device\device\models;

use nad\common\modules\device\models\DeviceInstanceDocument as ParentDocument;

class DeviceInstanceDocument extends ParentDocument
{
    const CONSUMER_CODE = DeviceInstanceDocument::class;

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/mechanics/device/device/device-instance-document/view';
    }

    // public static function find()
    // {
    //     return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    // }
}
