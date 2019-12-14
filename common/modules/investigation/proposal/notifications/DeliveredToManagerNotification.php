<?php

namespace nad\common\modules\investigation\proposal\notifications;

use extensions\notification\Notification;

class DeliveredToManagerNotification extends Notification
{
    public $proposal;
    public $moduleId = 'proposal';
    public $category = 'پروپوزال';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "{$this->proposal->title}";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->proposal->id
        ];
    }
}
