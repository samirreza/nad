<?php

namespace nad\common\modules\investigation\report\notifications;

use extensions\notification\Notification;

class ReportDeliverdToExpertNotification extends Notification
{
    public $report;
    public $moduleId = 'report';
    public $category = 'گزارش ';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "{$this->report->title}";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->report->id
        ];
    }
}
