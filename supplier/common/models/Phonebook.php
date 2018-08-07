<?php

namespace modules\nad\supplier\common\models;

use yii\db\ActiveRecord;

class Phonebook extends ActiveRecord
{
    public static function tableName()
    {
        return 'phonebook';
    }
}