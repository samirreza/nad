<?php

namespace nad\purchase\models;

use Yii;
use extensions\i18n\validators\FarsiCharactersValidator;
use extensions\i18n\validators\JalaliDateToTimestamp;
use nad\common\modules\investigation\common\behaviors\CommentBehavior;

/**
 * This is the model class for table "nad_purchase_form2".
 *
 * @property int $id
 * @property int $createdBy
 * @property int $updatedBy
 * @property int $createdAt
 * @property int $updatedAt
 * @property string $title
 * @property string $productName
 * @property string $productIdentifier
 * @property string $proposal
 */
class Form2 extends BaseForm
{
    public $moduleId = 'dummy'; // not important
    public $ownerClassName = __NAMESPACE__ . '\Form2';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nad_purchase_form2';
    }

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
    public function rules()
    {
        return [
            [['purchaseGlobalId', 'prevFormId', 'prevExpertId', 'prevRecordId'], 'safe'],
            [['title', 'productName', 'productIdentifier'], 'required'],
            [['proposal'], 'string'],
            [['title', 'productName', 'productIdentifier'], 'string', 'max' => 512],
            [['title', 'productName', 'productIdentifier', 'proposal'], 'trim'],
            [
                ['title', 'productName', 'productIdentifier', 'proposal'],
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
            'proposal' => 'پیشنهاد',
            'nextFormId' => 'اقدام بعدی',
            'nextExpertId' => 'کارشناس اقدام بعدی',
            'prevFormId' => 'اقدام قبلی',
            'prevExpertId' => 'کارشناس اقدام فعلی',
        ];
    }
}
