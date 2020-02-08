<?php

namespace nad\engineering\instrument\site\models;

use nad\common\modules\site\models\Site as ParentSite;

class Site extends ParentSite
{
    const CONSUMER_CODE = Site::class;

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
