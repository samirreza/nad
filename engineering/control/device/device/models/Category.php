<?php

namespace nad\engineering\control\device\device\models;

use nad\common\modules\device\models\Category as BaseCategory;

class Category extends BaseCategory
{
    const CONSUMER_CODE = Category::class;

    public static function find()
    {
        return parent::find()->andWhere([parent::tableName() . '.consumer' => self::CONSUMER_CODE]);
    }
}
