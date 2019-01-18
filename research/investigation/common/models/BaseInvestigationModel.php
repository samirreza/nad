<?php

namespace nad\research\investigation\common\models;

use Yii;
use yii\db\ActiveRecord;
use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use yii\behaviors\BlameableBehavior;
use core\behaviors\TimestampBehavior;
use modules\user\backend\models\User;
use nad\research\extensions\resource\behaviors\ResourceBehavior;

class BaseInvestigationModel extends ActiveRecord implements Codable
{
    use CodableTrait;

    public $sessionHourAttribute;
    public $sessionMinuteAttribute;

    const STATUS_REJECTED = 0;
    const STATUS_NEED_CORRECTION = 1;
    const STATUS_INPROGRESS = 2;
    const STATUS_DELIVERED_TO_MANAGER = 3;
    const STATUS_WAITING_FOR_MEETING = 4;
    const STATUS_MEETING_HELD = 5;
    const STATUS_ACCEPTED = 6;
    const STATUS_READY_FOR_NEXT_STEP = 7;
    const STATUS_IN_NEXT_STEP = 8;
    const STATUS_FINISHED = 9;

    const SCENARIO_SET_SESSION_DATE = 'setSessionDate';

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => false
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'createdBy',
                'updatedByAttribute' => false
            ],
            ResourceBehavior::class
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SET_SESSION_DATE] = [
            'sessionDate',
            'sessionHourAttribute',
            'sessionMinuteAttribute'
        ];
        return $scenarios;
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }

    public function getResearcher()
    {
        return $this->hasOne(User::class, ['id' => 'createdBy']);
    }

    public function changeStatus($newStatus)
    {
        $this->status = $newStatus;
        $this->save();
    }

    public function canUserUpdateOrDelete()
    {
        if (Yii::$app->user->can('research.manage')) {
            return true;
        }
        if(
            $this->status == self::STATUS_NEED_CORRECTION ||
            $this->status == self::STATUS_INPROGRESS
        ) {
            return Yii::$app->user->can(
                'research.manageOwnResearch',
                ['research' => $this]
            );
        }
        return false;
    }

    public function canUserDeliverToManager()
    {
        if (
            $this->status == self::STATUS_INPROGRESS ||
            $this->status == self::STATUS_NEED_CORRECTION
        ) {
            if (Yii::$app->user->can('research.manage')) {
                return true;
            }
            return Yii::$app->user->can(
                'research.manageOwnResearch',
                ['research' => $this]
            );
        }
        return false;
    }

    public function canSetSessionDate()
    {
        return $this->status == self::STATUS_DELIVERED_TO_MANAGER ||
            $this->status == self::STATUS_WAITING_FOR_MEETING;
    }

    public static function getStatusLables()
    {
        return [
            self::STATUS_REJECTED => 'رد شده',
            self::STATUS_NEED_CORRECTION => 'نیازمند اصلاح',
            self::STATUS_INPROGRESS => 'در حال تکمیل',
            self::STATUS_DELIVERED_TO_MANAGER => 'ارسال شده به مدیر',
            self::STATUS_WAITING_FOR_MEETING => 'در انتظار جلسه',
            self::STATUS_MEETING_HELD => 'جلسه برگزار شد',
            self::STATUS_ACCEPTED => 'پذیرفته شد',
            self::STATUS_READY_FOR_NEXT_STEP => 'آماده برای مرحله بعد',
            self::STATUS_IN_NEXT_STEP => 'قرار گرفته در مرحله بعد',
            self::STATUS_FINISHED => 'نهایی شده'
        ];
    }
}
