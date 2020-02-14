<?php

namespace nad\engineering\control\device\device\models;

use nad\common\modules\device\models\DocumentGroupDocument as ParentDocument;

class DocumentGroupDocument extends ParentDocument
{
    const CONSUMER_CODE = DocumentGroupDocument::class; //'nad\engineering\control';

    public $moduleId = 'control';

    public function getBaseViewRoute()
    {
        return '/control/device/device/document-group-document/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([parent::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
