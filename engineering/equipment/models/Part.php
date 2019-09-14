<?php

namespace nad\engineering\equipment\models;

use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use nad\extensions\thing\behaviors\ThingsDeleteBehavior;

class Part extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    public function behaviors()
    {
        return [
            [
                'class' => ThingsDeleteBehavior::class,
                'thingType' => ThingsDeleteBehavior::TYPE_EQUIPMENT_PART
            ]
        ];
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }

    public static function tableName()
    {
        return 'nad_equipment_type_part';
    }
}
