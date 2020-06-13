<?php

namespace nad\rla\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use core\behaviors\TimestampBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\helpers\Lookup;

/**
 * This is the model class for table "row_level_access_request".
 *
 * @property int $id
 * @property int $createdAt
 * @property int $updatedAt
 * @property string $description
 * @property int $type
 * @property int $status
 * @property int $is_read
 */
class RowLevelAccessRequest extends \yii\db\ActiveRecord
{
    public const REQUEST_TYPE_PREVIEW = 1;
    public const REQUEST_TYPE_RECORD = 2;

    public const REQUEST_STATUS_IN_PROGRSS = 1;
    public const REQUEST_STATUS_APPROVED_BY_MANAGER = 2;
    public const REQUEST_STATUS_REJECTED_BY_MANAGER = 3;
    public const REQUEST_STATUS_APPROVED = 4;
    public const REQUEST_STATUS_REJECTED = 5;

    public const REQUEST_IS_READ_YES = 1;
    public const REQUEST_IS_READ_NO = 2;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'createdBy',
                'updatedByAttribute' => 'updatedBy'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'row_level_access_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'type'], 'required'],
            [['type', 'status'], 'integer'],
            [['description'], 'string'],
            [['description'], 'trim'],
            [['description'], FarsiCharactersValidator::class],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی',
            'description' => 'متن درخواست',
            'type' => 'نوع درخواست',
            'status' => 'وضعیت',
            'is_read' => 'خوانده شده؟',
            'createdBy' => 'ارسال توسط',
            'updatedBy' => 'آخرین ویرایش توسط'
        ];
    }

    public function beforeSave($insert) {
        if ($insert) {
            $this->status = self::REQUEST_STATUS_IN_PROGRSS;
            $this->is_read = self::REQUEST_IS_READ_NO;
        }else{
            if(Yii::$app->user->id != $this->createdBy)
                $this->is_read = self::REQUEST_IS_READ_YES;
        }

        return parent::beforeSave($insert);

    }

    public static function getStatusOptions(){
        $options = Lookup::items('nad.rla.request.Status');
        unset($options[self::REQUEST_STATUS_IN_PROGRSS]); // در دست بررسی

        if(Yii::$app->user->can('superuser')){
            if(self::isCurrentUserMainAdmin()){
                // if user is admin or Mr Sepahsalari
                unset($options[self::REQUEST_STATUS_APPROVED]);
                unset($options[self::REQUEST_STATUS_REJECTED]);
            }else{
                // if user is operator (a special type of superuser)
                unset($options[self::REQUEST_STATUS_APPROVED_BY_MANAGER]);
                unset($options[self::REQUEST_STATUS_REJECTED_BY_MANAGER]);
            }
        }

        return $options;
    }

    public static function isCurrentUserMainAdmin(){
        return Yii::$app->user->id == 1 || Yii::$app->user->id == 3;
    }

    public static function getUnreadReuqestsCount(){
        return self::find()->andWhere(['status' => self::REQUEST_STATUS_IN_PROGRSS])->count();
    }
}
