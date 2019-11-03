<?php

namespace nad\common\modules\investigation\method\notifications;

use extensions\notification\Notification;

class DeliveredToManagerNotification extends Notification
{
    public $method;
    public $moduleId = 'method';
    public $category = 'ارسال روش';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "روش {$this->method->title} برای شما ارسال شده است.";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->method->id
        ];
    }
}
