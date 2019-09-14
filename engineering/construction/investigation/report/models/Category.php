<?php

namespace nad\engineering\construction\investigation\report\models;

use nad\common\modules\investigation\report\models\Category as BaseCategory;

class Category extends BaseCategory
{
    const CONSUMER_CODE = 'nad\engineering\construction';

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
