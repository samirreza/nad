<?php

namespace modules\nad\supplier\backend\models;

class Job extends \modules\nad\supplier\common\models\Job
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
            [['title',], 'required',],
            [['title',], 'trim'],
            ['title', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'title' => 'سمت',
            'createdAt' => 'تاریخ ثبت',
        ];
    }
}