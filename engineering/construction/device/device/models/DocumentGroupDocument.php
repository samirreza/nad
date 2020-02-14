<?php

namespace nad\engineering\construction\device\device\models;

use nad\common\modules\device\models\DocumentGroupDocument as ParentDocument;

class DocumentGroupDocument extends ParentDocument
{
    const CONSUMER_CODE = DocumentGroupDocument::class;

    public $moduleId = 'construction';

    public function getBaseViewRoute()
    {
        return '/construction/device/device/document-group-document/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
