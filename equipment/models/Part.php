<?php
namespace modules\nad\equipment\models;

class Part extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'nad_equipment_type_part';
    }

    public function getHtmlCodedTitle()
    {
        return '<span style="display: inline-block">' . $this->title . '</span><small> ['
            . $this->uniqueCode . '] </small>';
    }

    public function getCodedTitle()
    {
        return $this->title .  ' - ' . $this->uniqueCode;
    }
}
