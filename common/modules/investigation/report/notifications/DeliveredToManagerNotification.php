<?php

namespace nad\common\modules\investigation\report\notifications;

use extensions\notification\Notification;

class DeliveredToManagerNotification extends Notification
{
    public $report;
    public $moduleId = 'report';
    public $category = 'ارسال گزارش';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "گزارش {$this->report->title} برای شما ارسال شده است.";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->report->id
        ];
    }
}
