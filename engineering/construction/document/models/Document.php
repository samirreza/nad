<?php

namespace nad\engineering\construction\document\models;

use nad\common\modules\engineering\document\models\Document as ParentDocument;

class Document extends ParentDocument
{
    const CONSUMER_CODE = Document::class; //'nad\engineering\construction';

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/construction/document/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
