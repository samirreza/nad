<?php

namespace modules\nad\supplier\common\models;

use yii\db\ActiveRecord;

class Supplier extends ActiveRecord
{
    public static function tableName()
    {
        return 'nad_supplier';
    }
}
