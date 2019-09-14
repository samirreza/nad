<?php

namespace nad\engineering\instrument\investigation\report\models;

use nad\common\modules\investigation\report\models\Category as BaseCategory;

class Category extends BaseCategory
{
    const CONSUMER_CODE = 'nad\engineering\instrument';

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
