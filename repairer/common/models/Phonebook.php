<?php

namespace modules\nad\repairer\common\models;

use yii\db\ActiveRecord;

class Phonebook extends ActiveRecord
{
    public static function tableName()
    {
        return 'nad_repairer_phonebook';
    }
}