<?php

namespace nad\common\modules\investigation\report\notifications;

use extensions\notification\Notification;

class ReportDeliverdToExpertNotification extends Notification
{
    public $report;
    public $moduleId = 'report';
    public $category = 'گزارش نیازمند اصلاح';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "گزارش «{$this->report->title}» جهت اصلاح مجددا به شما ارسال شده است.";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->report->id
        ];
    }
}
