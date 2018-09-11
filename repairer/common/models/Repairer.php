<?php

namespace modules\nad\repairer\common\models;

use yii\db\ActiveRecord;
use modules\nad\repairer\common\behaviors\WorksBehavior;
use modules\nad\repairer\common\behaviors\PartsBehavior;
use modules\nad\repairer\common\behaviors\EquipmentsBehavior;

class Repairer extends ActiveRecord
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
        return 'nad_repairer';
    }
}