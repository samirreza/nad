<?php

namespace nad\factory\production\unit4\investigation3\method\models;

use nad\common\modules\investigation\method\models\Category as BaseCategory;

class Category extends BaseCategory
{
    const CONSUMER_CODE = Category::class;

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
