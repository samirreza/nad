<?php

namespace nad\purchase\models;

use Yii;
use extensions\i18n\validators\FarsiCharactersValidator;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\common\modules\investigation\common\behaviors\CommentBehavior;

/**
 * This is the model class for table "nad_purchase_form4".
 *
 * @property int $id
 * @property int $createdBy
 * @property int $updatedBy
 * @property int $createdAt
 * @property int $updatedAt
 * @property string $title
 * @property string $factorNumber
 * @property double $price
 * @property string $productName
 * @property string $technicalNumber
 * @property string $accountNumber
 * @property string $accountOwnerName
 * @property string $accountBankName
 */
class Form4 extends BaseForm
{
    public $moduleId = 'dummy'; // not important
    public $ownerClassName = __NAMESPACE__ . '\Form4';

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'comments' => [
                    'class' => CommentBehavior::class,
                    'moduleId' => $this->moduleId,
                    'customOwner' => $this->ownerClassName
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nad_purchase_form4';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purchaseGlobalId', 'prevFormId', 'prevExpertId', 'prevRecordId'], 'safe'],
            [['title', 'factorNumber', 'price', 'productName'], 'required'],
            [['price'], 'number'],
            [['title', 'factorNumber', 'productName', 'technicalNumber', 'accountNumber', 'accountOwnerName', 'accountBankName'], 'string', 'max' => 512],
            [['title', 'factorNumber', 'productName', 'technicalNumber', 'accountNumber', 'accountOwnerName', 'accountBankName'], 'trim'],
            [['title', 'factorNumber', 'productName', 'technicalNumber', 'accountNumber', 'accountOwnerName', 'accountBankName'], FarsiCharactersValidator::class],
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
            'factorNumber' => 'شماره فاکتور',
            'price' => 'قیمت',
            'technicalNumber' => 'شماره فنی',
            'accountNumber' => 'شماره حساب',
            'accountOwnerName' => 'صاحب حساب',
            'accountBankName' => 'نام بانک',
            'nextFormId' => 'اقدام بعدی',
            'nextExpertId' => 'کارشناس اقدام بعدی',
            'prevFormId' => 'اقدام قبلی',
            'prevExpertId' => 'کارشناس اقدام فعلی',
        ];
    }
}
