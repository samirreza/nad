<?php
namespace modules\nad\equipment\models;

use nad\common\code\Codable;
use nad\common\code\CodableTrait;

class Part extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    public static function tableName()
    {
        return 'nad_equipment_type_part';
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }
}
