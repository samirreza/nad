<?php

namespace nad\rla\models;

use Yii;
use yii\helpers\Html;

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
    public $userIds;
    public $itemTypes;

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
            [['userIds'], 'safe'],
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
        ];
    }
}
