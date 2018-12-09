<?php

namespace modules\nad\material\models;

use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use nad\extensions\thing\behaviors\ThingsDeleteBehavior;

class Type extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    public function behaviors()
    {
        return [
            [
                'class' => ThingsDeleteBehavior::class,
                'thingType' => ThingsDeleteBehavior::TYPE_MATERIAL
            ]
        ];
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }

    public static function tableName()
    {
        return 'nad_material_type';
    }
}
