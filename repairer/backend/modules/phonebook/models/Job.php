<?php

namespace modules\nad\repairer\backend\modules\phonebook\models;

use core\behaviors\PreventDeleteBehavior;

class Job extends \modules\nad\repairer\common\models\Job
{
    public function behaviors()
    {
        return [
            'core\behaviors\TimestampBehavior',
            [
                'class' => PreventDeleteBehavior::class,
                'relations' => [
                    [
                        'relationMethod' => 'getPhones',
                        'relationName' => 'شماره تماس ها'
                    ]
                ]
            ]
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

    public function getPhones()
    {
        return $this->hasMany(Phonebook::class, ['jobId' => 'id']);
    }
}