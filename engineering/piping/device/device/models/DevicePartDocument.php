<?php

namespace nad\engineering\piping\device\device\models;

use nad\common\modules\device\models\DevicePartDocument as ParentDocument;

class DevicePartDocument extends ParentDocument
{
    const CONSUMER_CODE = DevicePartDocument::class;

    public $moduleId = 'piping';

    public function getBaseViewRoute()
    {
        return '/piping/device/device/device-part-document/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
