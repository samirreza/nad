<?php

namespace modules\nad\supplier\common\models;

use yii\db\ActiveRecord;
use modules\nad\supplier\common\behaviors\EquipmentsBehavior;

class Supplier extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'equipments' => EquipmentsBehavior::class,
        ];
    }

    public static function tableName()
    {
        return 'nad_supplier';
    }
}
