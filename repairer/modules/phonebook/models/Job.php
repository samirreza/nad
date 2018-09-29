<?php

namespace modules\nad\repairer\modules\phonebook\models;

use core\behaviors\PreventDeleteBehavior;

class Job extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'nad_repairer_phonebook_jobs';
    }

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