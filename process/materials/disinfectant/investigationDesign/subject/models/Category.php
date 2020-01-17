<?php

namespace nad\process\materials\disinfectant\investigationDesign\subject\models;

use nad\common\modules\investigation\subject\models\Category as BaseCategory;

class Category extends BaseCategory
{
    const CONSUMER_CODE = Category::class;

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
