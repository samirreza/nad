<?php

namespace nad\engineering\piping\document\models;

use nad\common\modules\engineering\document\models\Document as ParentDocument;

class Document extends ParentDocument
{
    const CONSUMER_CODE = 'nad\engineering\piping';

    public $moduleId = 'pipping';

    public function getBaseViewRoute()
    {
        return '/piping/document/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
