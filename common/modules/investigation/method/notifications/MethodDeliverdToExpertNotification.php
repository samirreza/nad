<?php

namespace nad\common\modules\investigation\method\notifications;

use extensions\notification\Notification;

class MethodDeliverdToExpertNotification extends Notification
{
    public $method;
    public $moduleId = 'method';
    public $category = 'روش نیازمند اصلاح';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "روش «{$this->method->title}» جهت اصلاح مجددا به شما ارسال شده است.";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->method->id
        ];
    }
}
