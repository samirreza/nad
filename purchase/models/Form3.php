<?php

namespace nad\purchase\models;

use Yii;
use extensions\i18n\validators\FarsiCharactersValidator;
use extensions\i18n\validators\JalaliDateToTimestamp;

/**
 * This is the model class for table "nad_purchase_form3".
 *
 * @property int $id
 * @property int $createdBy
 * @property int $updatedBy
 * @property int $createdAt
 * @property int $updatedAt
 * @property string $title
 * @property string $productName
 * @property string $productIdentifier
 * @property int $deliveryDate
 * @property double $price
 * @property double $prepayment
 */
class Form3 extends BaseForm
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nad_purchase_form3';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purchaseGlobalId', 'prevFormId', 'prevExpertId'], 'safe'],
            [['title', 'productName', 'productIdentifier'], 'required'],
            [
                'deliveryDate',
                JalaliDateToTimestamp::class,
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $model->getOldAttribute($attribute);
                }
            ],
            [['price', 'prepayment'], 'number'],
            [['title', 'productName', 'productIdentifier'], 'string', 'max' => 512],
            [['title', 'productName', 'productIdentifier'], 'trim'],
            [
                ['title', 'productName', 'productIdentifier'],
                FarsiCharactersValidator::class
            ],
            [
                ['nextFormId', 'nextExpertId'],
                'validateTwoDependentRequiredFields',
                'skipOnEmpty' => false
            ],
        ];
    }

    public function validateTwoDependentRequiredFields($attribute, $params){
        if (
            (empty($this->nextFormId) && !empty($this->nextExpertId))
            ||
            (!empty($this->nextFormId) && empty($this->nextExpertId))
            ) {
            $errorMessage = 'فرم بعدی و کارشناس فرم بعدی را انتخاب کنید.';
            $this->addError('nextFormId', $errorMessage);
            $this->addError('nextExpertId',  $errorMessage);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'createdBy' => 'تاریخ درج',
            'updatedBy' => 'آخرین ویرایش توسط',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین ویرایش',
            'title' => 'عنوان درخواست',
            'productName' => 'نام کالا',
            'productIdentifier' => 'شناسه کالا',
            'deliveryDate' => 'تاریخ تحویل',
            'price' => 'قیمت',
            'prepayment' => 'پیش پرداخت',
            'nextFormId' => 'فرم بعدی',
            'nextExpertId' => 'کارشناس فرم بعدی',
            'prevFormId' => 'فرم قبلی',
            'prevExpertId' => 'کارشناس فرم قبلی',
        ];
    }
}
