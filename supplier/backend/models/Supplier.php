<?php

namespace modules\nad\supplier\backend\models;

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
                    'isForeign',
                    'kind',
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
            ['description', 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'name' => 'نام تامین کننده',
            'isForeign' => 'داخلی / خارجی',
            'kind' => ' نوع تامین کننده',
            'email' => 'پست الکترونیکی',
            'website' => 'ادرس وبسایت',
            'shopAddress' => 'آدرس مغازه / دفتر',
            'factoryAddress' => 'آدرس کارخانه',
            'paymentType' => 'نحوه پرداخت',
            'description' => 'توضیحات',
            'createdAt' => 'تاریخ ثبت',
            'phoneCount' => 'تعداد شماره تماس',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->website == '') {
                $this->website = null;
            }
            if ($this->email == '') {
                $this->email = null;
            }
            if ($this->description == '') {
                $this->description = null;
            }
            return true;
        } else {
            return false;
        }
    }

    public function getKind()
    {
        $kinds = self::getKindsList();
        return isset($kinds[$this->kind]) ? $kinds[$this->kind] : null;
    }

    public static function getKindsList()
    {
        return [
            0 => 'سازنده',
            1 => 'پخش کننده',
            2 => 'نماینده - انحصاری',
            3 => 'نماینده - عمومی'
        ];
    }

    public function setPaymentType()
    {
        switch ($this->paymentType) {
            case 0:
                return 'نقدی';
            case 1:
                return 'شرایطی';
            case 2:
                return 'هردو';
        }
    }

    public function getPhones()
    {
        return $this->hasMany(Phonebook::class, ['supplierId' => 'id']);
    }
}
