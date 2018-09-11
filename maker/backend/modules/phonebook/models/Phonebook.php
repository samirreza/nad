<?php

namespace modules\nad\maker\backend\modules\phonebook\models;

use modules\nad\maker\backend\models\Maker;

class Phonebook extends \modules\nad\maker\common\models\Phonebook
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
            [['makerId', 'jobId'], 'safe'],
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

    public function getMaker()
    {
        return $this->hasOne(Maker::class, ['id' => 'makerId']);
    }

    public function getJob()
    {
        return $this->hasOne(Job::class, ['id' => 'jobId']);
    }
}