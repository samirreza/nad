<?php

namespace nad\factory\build\unit2\investigation2\instruction\models;

use nad\common\modules\investigation\instruction\models\Category as BaseCategory;

class Category extends BaseCategory
{
    const CONSUMER_CODE = Category::class;

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
