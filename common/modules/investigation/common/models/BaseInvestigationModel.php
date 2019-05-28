<?php

namespace nad\common\modules\investigation\common\models;

use Yii;
use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use modules\user\common\models\User;
use yii\behaviors\BlameableBehavior;
use core\behaviors\TimestampBehavior;

class BaseInvestigationModel extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    const STATUS_INPROGRESS = 0;
    const STATUS_IN_MANAGER_HAND = 1;
    const STATUS_WAITING_FOR_SESSION = 2;
    const STATUS_WAIT_FOR_NEGOTIATION = 3;
    const STATUS_WAIT_FOR_CONVERSATION = 4;
    const STATUS_NEED_CORRECTION = 5;
    const STATUS_REJECTED = 6;
    const STATUS_ACCEPTED = 7;
    const STATUS_IN_NEXT_STEP = 8;

    const SCENARIO_SET_SESSION_DATE = 'setSessionDate';
    const SCENARIO_WRITE_PROCEEDINGS = 'writeProceedings';
    const SCENARIO_WRITE_NEGOTIATION_RESULT = 'writeNegotiationResult';
    const SCENARIO_SET_EXPERT = 'setExpert';

    public $moduleId;

    public $sessionHourAttribute;
    public $sessionMinuteAttribute;

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
            ]
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
        $scenarios[self::SCENARIO_WRITE_PROCEEDINGS] = ['proceedings'];
        $scenarios[self::SCENARIO_WRITE_NEGOTIATION_RESULT] = ['negotiationResult'];
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

    public function getResearcherTitle()
    {
        if (!empty(trim($this->researcher->fullName))) {
            return $this->researcher->fullName;
        }
        return $this->researcher->email;
    }

    public function changeStatus($newStatus)
    {
        $this->status = $newStatus;
        $this->save();
    }

    public function canUserUpdateOrDelete()
    {
        if (Yii::$app->user->can('superuser')) {
            return true;
        }
        if (
            $this->status == self::STATUS_NEED_CORRECTION ||
            $this->status == self::STATUS_INPROGRESS
        ) {
            return Yii::$app->user->can(
                'investigation.manageOwnInvestigation',
                ['investigation' => $this]
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
            if (Yii::$app->user->can('superuser')) {
                return true;
            }
            return Yii::$app->user->can(
                'investigation.manageOwnInvestigation',
                ['investigation' => $this]
            );
        }
        return false;
    }

    public function canSetSessionDate()
    {
        return $this->status == self::STATUS_WAITING_FOR_SESSION &&
            !$this->proceedings;
    }

    public function canWriteProceedings()
    {
        return $this->status == self::STATUS_WAITING_FOR_SESSION &&
            $this->sessionDate <= time();
    }

    public function canWriteNegotiationResult()
    {
        return $this->status == self::STATUS_WAIT_FOR_NEGOTIATION;
    }

    public function canHaveConverstation()
    {
        if ($this->status == self::STATUS_WAIT_FOR_CONVERSATION) {
            return Yii::$app->user->can(
                'investigation.manageOwnInvestigation',
                ['investigation' => $this]
            );
        }
        return false;
    }

    public function canAcceptOrRejectOrCorrect()
    {
        if ($this->status == self::STATUS_IN_MANAGER_HAND) {
            return true;
        }
        if (
            $this->status == self::STATUS_WAITING_FOR_SESSION &&
            $this->proceedings
        ) {
            return true;
        }
        if (
            $this->status == self::STATUS_WAIT_FOR_NEGOTIATION &&
            $this->negotiationResult
        ) {
            return true;
        }
        if (
            $this->status == self::STATUS_WAIT_FOR_CONVERSATION &&
            $this->comments
        ) {
            return true;
        }
        return false;
    }

    public static function getStatusLables()
    {
        return [
            self::STATUS_INPROGRESS => 'در دست تهیه',
            self::STATUS_IN_MANAGER_HAND => 'نزد مدیر',
            self::STATUS_WAITING_FOR_SESSION => 'نوبت جلسه',
            self::STATUS_WAIT_FOR_NEGOTIATION => 'نوبت مذاکره',
            self::STATUS_WAIT_FOR_CONVERSATION => 'تبادل نظر',
            self::STATUS_NEED_CORRECTION => 'نیازمند اصلاح',
            self::STATUS_REJECTED => 'رد',
            self::STATUS_ACCEPTED => 'قبول'
        ];
    }
}
