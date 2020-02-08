<?php

namespace nad\engineering\control\device\device\models;

use nad\common\modules\device\models\DocumentGroup as ParentDocumentGroup;

class DocumentGroup extends ParentDocumentGroup
{
    const CONSUMER_CODE = DocumentGroup::class;

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/control/device/device/document-group/view';
    }

    // public static function find()
    // {
    //     return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    // }
}
