<?php

namespace nad\engineering\geotechnics\device\device\models;

use nad\common\modules\device\models\DocumentGroupDocument as ParentDocument;

class DocumentGroupDocument extends ParentDocument
{
    const CONSUMER_CODE = DocumentGroupDocument::class;

    public $moduleId = 'geotechnics';

    public function getBaseViewRoute()
    {
        return '/geotechnics/device/device/document-group-document/view';
    }

    public static function find()
    {
        return parent::find()->andWhere([self::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
