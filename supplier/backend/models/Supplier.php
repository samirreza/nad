<?php

namespace modules\nad\supplier\backend\models;

use modules\nad\equipment\modules\type\models\Type as EquipmentType;
use modules\nad\material\modules\type\models\Type as MaterialType;
use modules\nad\supplier\backend\modules\phonebook\models\Phonebook;

class Supplier extends \modules\nad\supplier\common\models\Supplier
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = 'core\behaviors\TimestampBehavior';
        return $behaviors;
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
                    'paymentType',
                    'isActive'
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
            [['phone', 'fax'], 'integer'],
            [['description', 'website', 'email', 'fax','factoryAddress'], 'default', 'value' => null],
            [['description', 'materials', 'equipments'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'name' => 'نام تامین کننده',
            'isForeign' => 'داخلی / خارجی',
            'isActive' => 'نماینده فعال است',
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
            'equipments' => 'تجهیزات',
            'materials' => 'مواد',
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

    public function getEquipTypes()
    {
        return $this->hasMany(
            EquipmentType::class,
            ['id' => 'equipmentId']
        )->viaTable('nad_supplier_equipment_relation', ['supplierId' => 'id']);
    }

    public function getMatTypes()
    {
        return $this->hasMany(
            MaterialType::class,
            ['id' => 'materialId']
        )->viaTable('nad_supplier_material_relation', ['supplierId' => 'id']);
    }
}
