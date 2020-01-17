<?php

namespace nad\common\modules\investigation\otherreport\notifications;

use extensions\notification\Notification;

class OtherreportDeliverdToExpertNotification extends Notification
{
    public $otherreport;
    public $moduleId = 'otherreport';
    public $category = 'گزارش';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "{$this->otherreport->title}";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->otherreport->id
        ];
    }
}
