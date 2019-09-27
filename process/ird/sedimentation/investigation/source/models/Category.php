<?php

namespace nad\process\ird\sedimentation\investigation\source\models;

use nad\common\modules\investigation\source\models\Category as BaseCategory;

class Category extends BaseCategory
{
    const CONSUMER_CODE = 'SR';

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
