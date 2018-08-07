<?php

namespace modules\nad\supplier\common\models;

use yii\db\ActiveRecord;

class Job extends ActiveRecord
{
    public static function tableName()
    {
        return 'nad_supplier_phonebook_jobs';
    }
}