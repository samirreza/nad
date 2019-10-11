<?php

namespace nad\extensions\comment\models;

use Yii;
use modules\user\common\models\User;
use yii\behaviors\BlameableBehavior;
use core\behaviors\TimestampBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\extensions\comment\behaviors\NotificationBehavior;

class Comment extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'Timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'insertedAt',
                'updatedAtAttribute' => false
            ],
            'BlameableBehavior' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'insertedBy',
                'updatedByAttribute' => false
            ],
            'notification' => NotificationBehavior::class
        ];
    }

    public function rules()
    {
        return [
            ['content', 'required'],
            ['content', 'string'],
            ['content', FarsiCharactersValidator::class]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'content' => 'نظر',
            'insertedBy' => 'درج کننده',
            'insertedAt' => 'تاریخ درج'
        ];
    }

    public function isSentByThisUser()
    {
        return $this->insertedBy == Yii::$app->user->id;
    }

    public static function tableName()
    {
        return 'comment';
    }

    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'insertedBy']);
    }
}
