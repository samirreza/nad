<?php

namespace nad\research\common\models;

class BaseReasearch extends \yii\db\ActiveRecord
{
    const STATUS_REJECTED = 0;
    const STATUS_NEED_CORRECTION = 1;
    const STATUS_INPROGRESS = 2;
    const STATUS_DELIVERED_TO_MANAGER = 3;
    const STATUS_WAITING_FOR_MEETING = 4;
    const STATUS_MEETING_HELD = 5;
    const STATUS_ACCEPTED = 6;

    public function changeStatus($newStatus)
    {
        $this->status = $newStatus;
        $this->save();
    }

    public function canDeliverToManager()
    {
        return $this->status == self::STATUS_INPROGRESS ||
            $this->status == self::STATUS_NEED_CORRECTION;
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
            self::STATUS_ACCEPTED => 'پذیرفته شد'
        ];
    }
}
