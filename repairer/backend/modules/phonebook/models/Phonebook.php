<?php

namespace modules\nad\repairer\backend\modules\phonebook\models;

use modules\nad\repairer\backend\models\Repairer;

class Phonebook extends \modules\nad\repairer\common\models\Phonebook
{
    public function behaviors()
    {
        return [
            'core\behaviors\TimestampBehavior',
        ];
    }

    public function rules()
    {
        return [
            [['name', 'phone', 'jobId'], 'required',],
            [['name', 'email'], 'trim'],
            ['name', 'string', 'max' => 255],
            ['phone', 'integer'],
            ['email', 'email'],
            [['repairerId', 'jobId'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'name' => 'نام',
            'phone' => 'شماره تماس',
            'email' => 'پست الکترونیکی',
            'jobId' => 'سمت',
            'createdAt' => 'تاریخ ثبت',
        ];
    }

    public function getRepairer()
    {
        return $this->hasOne(Repairer::class, ['id' => 'repairerId']);
    }

    public function getJob()
    {
        return $this->hasOne(Job::class, ['id' => 'jobId']);
    }
}