<?php

namespace nad\common\modules\investigation\source\notifications;

use extensions\notification\Notification;

class DeliveredToManagerNotification extends Notification
{
    public $source;
    public $moduleId = 'source';
    public $category = 'ارسال منشا';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "منشا {$this->source->title} برای شما ارسال شده است.";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->source->id
        ];
    }
}
