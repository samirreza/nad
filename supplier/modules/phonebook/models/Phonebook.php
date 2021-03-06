<?php

namespace modules\nad\supplier\modules\phonebook\models;

class Phonebook extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'nad_supplier_phonebook';
    }

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
            [['supplierId', 'jobId'], 'safe'],
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

    public function getSupplier()
    {
        return $this->hasOne(Supplier::class, ['id' => 'supplier_id']);
    }

    public function getJob()
    {
        return $this->hasOne(Job::class, ['id' => 'jobId']);
    }
}