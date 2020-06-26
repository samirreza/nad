<?php

namespace nad\rla\models;

use Yii;
use yii\helpers\Html;
use core\behaviors\TimestampBehavior;

/**
 * This is the model class for table "row_level_access".
 *
 * @property int $id
 * @property int $seq_access_id
 * @property int $user_id
 * @property int $access_type
 * @property int $expire_date
 */
class RowLevelAccessPreview extends \yii\db\ActiveRecord
{
    public const ROW_LEVEL_ACCESS_TYPE_PERMANENT = 1;
    public const ROW_LEVEL_ACCESS_TYPE_TEMPORARY = 2;

    public $userIds;
    public $itemTypes;
    public $accessTypes;
    public $expireDates;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'row_level_access_preview';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['itemTypes'], 'required'],
            [['userIds', 'accessTypes', 'expireDates'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itemTypes' => 'لیست داده گاه های قابل پیش نمایش',
            'user_id' => 'User ID',
            'access_type' => 'دسترسی زماندار',
            'expire_date' => 'Expire Date',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ],
        ];
    }
}
