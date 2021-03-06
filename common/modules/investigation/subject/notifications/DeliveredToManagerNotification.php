<?php

namespace nad\common\modules\investigation\subject\notifications;

use extensions\notification\Notification;

class DeliveredToManagerNotification extends Notification
{
    public $subject;
    public $moduleId = 'subject';
    public $category = 'موضوع/گزارش';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "{$this->subject->title}";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->subject->id
        ];
    }
}
