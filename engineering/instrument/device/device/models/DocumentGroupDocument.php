<?php

namespace nad\engineering\instrument\device\device\models;

use nad\common\modules\device\models\DocumentGroupDocument as ParentDocument;

class DocumentGroupDocument extends ParentDocument
{
    const CONSUMER_CODE = DocumentGroupDocument::class; //'nad\engineering\instrument';

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/instrument/device/device/document-group-document/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
