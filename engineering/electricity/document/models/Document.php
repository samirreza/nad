<?php

namespace nad\engineering\electricity\document\models;

use nad\common\modules\engineering\document\models\Document as ParentDocument;

class Document extends ParentDocument
{
    const CONSUMER_CODE = Document::class; //'nad\engineering\electricity';

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/electricity/document/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
