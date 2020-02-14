<?php

namespace nad\engineering\piping\device\device\models;

use nad\common\modules\device\models\DeviceCategoryDocument as ParentDocument;

class DeviceCategoryDocument extends ParentDocument
{
    const CONSUMER_CODE = DeviceCategoryDocument::class;

    public $moduleId = 'piping';

    public function getBaseViewRoute()
    {
        return '/piping/device/device/device-category-document/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
