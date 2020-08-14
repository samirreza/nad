<?php

namespace nad\engineering\piping\stage\investigation4\method\models;

use nad\common\modules\investigation\method\models\Category as BaseCategory;

class Category extends BaseCategory
{
    const CONSUMER_CODE = Category::class;

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
