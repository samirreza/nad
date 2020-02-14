<?php

namespace nad\temporary\informationtech\unit2\investigation5\instruction\models;

use nad\common\modules\investigation\instruction\models\Category as BaseCategory;

class Category extends BaseCategory
{
    const CONSUMER_CODE = Category::class;

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
