<?php
namespace nad\it\models;

use nad\common\code\Codable;
use nad\common\code\CodableTrait;

class EquipmentType extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    public static function tableName()
    {
        return 'nad_it_equipment_type';
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }
}
