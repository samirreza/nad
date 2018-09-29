<?php

namespace modules\nad\maker\common\models;

use yii\db\ActiveRecord;
use modules\nad\maker\common\behaviors\WorksBehavior;
use modules\nad\maker\common\behaviors\PartsBehavior;
use modules\nad\maker\common\behaviors\EquipmentsBehavior;

class Maker extends ActiveRecord
{

    public function behaviors()
    {
        return [
            'works' => WorksBehavior::class,
            'equipments' => EquipmentsBehavior::class,
            'parts' => PartsBehavior::class,
        ];
    }

    public static function tableName()
    {
        return 'nad_maker';
    }
}