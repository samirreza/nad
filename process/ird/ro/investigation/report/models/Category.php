<?php

namespace nad\process\ird\ro\investigation\report\models;

use nad\common\modules\investigation\report\models\Category as BaseCategory;

class Category extends BaseCategory
{
    const CONSUMER_CODE = 'RO';

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
