<?php

namespace nad\common\modules\investigation\method\notifications;

use extensions\notification\Notification;

class DeliveredToManagerNotification extends Notification
{
    public $method;
    public $moduleId = 'method';
    public $category = 'روش';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "{$this->method->title}";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->method->id
        ];
    }
}
