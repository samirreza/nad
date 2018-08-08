<?php

namespace modules\nad\supplier\backend\models;

use modules\nad\supplier\backend\modules\phonebook\models\Phonebook;

class Supplier extends \modules\nad\supplier\common\models\Supplier
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
            [
                [
                    'name',
                    'phone',
                    'isForeign',
                    'type',
                    'shopAddress',
                    'factoryAddress',
                    'paymentType',
                ],
                'required',
            ],
            [
                [
                    'name',
                    'email',
                    'website',
                ],
                'trim'
            ],

            [['name', 'email', 'website'], 'unique'],
            ['name', 'string', 'max' => 255],
            ['email', 'email'],
            ['website', 'url'],
            [['phone','fax'], 'integer'],
            [['description','website','email','fax'], 'default', 'value' => null],
            ['description', 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'name' => 'نام تامین کننده',
            'isForeign' => 'داخلی / خارجی',
            'type' => ' نوع تامین کننده',
            'email' => 'پست الکترونیکی',
            'website' => 'ادرس وبسایت',
            'phone' => 'تلفن دفتر تامین کننده',
            'fax' => 'فکس',
            'shopAddress' => 'آدرس مغازه / دفتر',
            'factoryAddress' => 'آدرس کارخانه',
            'paymentType' => 'نحوه پرداخت',
            'description' => 'توضیحات',
            'createdAt' => 'تاریخ ثبت',
            'phoneCount' => 'تعداد شماره تماس',
        ];
    }

    public function getType()
    {
        $types = self::getTypesList();
        return isset($types[$this->type]) ? $types[$this->type] : null;
    }

    public static function getTypesList()
    {
        return [
            0 => 'سازنده',
            1 => 'پخش کننده',
            2 => 'نماینده - انحصاری',
            3 => 'نماینده - عمومی'
        ];
    }

    public function getPaymentType()
    {
        $paymentType = self::getPaymentTypeList();
        return isset($paymentType[$this->paymentType]) ? $paymentType[$this->paymentType] : null;
    }

    public static function getPaymentTypeList()
    {
        return [
            0 => 'نقدی',
            1 => 'شرایطی',
            2 => 'هردو',
        ];
    }

    public function getPhones()
    {
        return $this->hasMany(Phonebook::class, ['supplierId' => 'id']);
    }

    public function getPhonesAsArray()
    {
        $values = [];
        $index = 0;

        $phones = Phonebook::find()
            ->andWhere(['supplierId' => $this->id])
            ->orderBy('id')
            ->all();

        foreach ($phones as $phone) {
            $values[$index]['phone'] = $phone->phone;
            $values[$index]['job'] = $phone->job->title;
            $values[$index]['name'] = $phone->name;
            $index++;
        }

        return $values;
    }
}