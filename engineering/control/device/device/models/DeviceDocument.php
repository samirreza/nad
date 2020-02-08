<?php

namespace nad\engineering\control\device\device\models;

use nad\common\modules\device\models\DeviceDocument as ParentDocument;

class DeviceDocument extends ParentDocument
{
    const CONSUMER_CODE = DeviceDocument::class;

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/control/device/device/device-document/view';
    }

    // public static function find()
    // {
    //     return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    // }
}
