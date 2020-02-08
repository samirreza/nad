<?php

namespace nad\engineering\electricity\device\device\models;

use nad\common\modules\device\models\DevicePartDocument as ParentDocument;

class DevicePartDocument extends ParentDocument
{
    const CONSUMER_CODE = DevicePartDocument::class;

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/electricity/device/device/device-part-document/view';
    }

    // public static function find()
    // {
    //     return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    // }
}
