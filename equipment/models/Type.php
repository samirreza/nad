<?php
namespace modules\nad\equipment\models;

use nad\common\code\Codable;
use nad\common\code\CodableTrait;

class Type extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    public static function tableName()
    {
        return 'nad_equipment_type';
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }
}
