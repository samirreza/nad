<?php

namespace nad\build\construction\unit2\investigation3\source\models;

use nad\common\modules\investigation\source\models\Category as BaseCategory;

class Category extends BaseCategory
{
    const CONSUMER_CODE = Category::class;

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
