<?php

namespace nad\engineering\electricity\device\device\models;

use nad\common\modules\device\models\DeviceDocument as ParentDocument;

class DeviceDocument extends ParentDocument
{
    const CONSUMER_CODE = DeviceDocument::class;

    public $moduleId = 'electricity';

    public function getBaseViewRoute()
    {
        return '/electricity/device/device/device-document/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
