<?php

namespace nad\purchase\models;

use Yii;
use extensions\i18n\validators\FarsiCharactersValidator;
use extensions\i18n\validators\JalaliDateToTimestamp;

/**
 * This is the model class for table "nad_purchase_form1".
 *
 * @property int $id
 * @property int $createdBy
 * @property int $updatedBy
 * @property int $createdAt
 * @property int $updatedAt
 * @property string $title
 * @property string $reason
 */
class Form1 extends BaseForm
{

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            []
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nad_purchase_form1';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['reason'], 'string'],
            [['title'], 'string', 'max' => 512],
            [['title', 'reason'], 'trim'],
            [
                ['title', 'reason'],
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
            'reason' => 'علت درخواست',
            'nextFormId' => 'فرم بعدی',
            'nextExpertId' => 'کارشناس فرم بعدی',
        ];
    }
}
