<?php

namespace nad\engineering\construction\device\device\models;

use nad\common\modules\device\models\DevicePartDocument as ParentDocument;

class DevicePartDocument extends ParentDocument
{
    const CONSUMER_CODE = DevicePartDocument::class;

    public $moduleId = 'construction';

    public function getBaseViewRoute()
    {
        return '/construction/device/device/device-part-document/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
