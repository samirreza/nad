<?php

namespace nad\engineering\control\document\models;

use nad\common\modules\engineering\document\models\Document as ParentDocument;

class Document extends ParentDocument
{
    const CONSUMER_CODE = Document::class; //'nad\engineering\control';

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/control/document/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
