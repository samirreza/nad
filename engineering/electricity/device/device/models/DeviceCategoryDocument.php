<?php

namespace nad\engineering\electricity\device\device\models;

use nad\common\modules\device\models\DeviceCategoryDocument as ParentDocument;

class DeviceCategoryDocument extends ParentDocument
{
    const CONSUMER_CODE = DeviceCategoryDocument::class;

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/electricity/device/device/device-category-document/view';
    }

    // public static function find()
    // {
    //     return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    // }
}
