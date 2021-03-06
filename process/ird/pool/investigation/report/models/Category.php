<?php

namespace nad\process\ird\pool\investigation\report\models;

use nad\common\modules\investigation\report\models\Category as BaseCategory;

class Category extends BaseCategory
{
    const CONSUMER_CODE = 'SD';

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
