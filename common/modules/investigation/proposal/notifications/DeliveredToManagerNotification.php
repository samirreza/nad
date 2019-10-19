<?php

namespace nad\common\modules\investigation\proposal\notifications;

use extensions\notification\Notification;

class DeliveredToManagerNotification extends Notification
{
    public $proposal;
    public $moduleId = 'proposal';
    public $category = 'ارسال پروپوزال';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "پروپوزال {$this->proposal->title} برای شما ارسال شده است.";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->proposal->id
        ];
    }
}
