<?php

namespace nad\engineering\instrument\site\models;

use nad\common\modules\site\models\Document as ParentDocument;

class Document extends ParentDocument
{
    const CONSUMER_CODE = Document::class;

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/instrument/site/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
