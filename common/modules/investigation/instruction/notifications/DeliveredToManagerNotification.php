<?php

namespace nad\common\modules\investigation\instruction\notifications;

use extensions\notification\Notification;

class DeliveredToManagerNotification extends Notification
{
    public $instruction;
    public $moduleId = 'instruction';
    public $category = 'ارسال دستورالعمل';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "دستورالعمل {$this->instruction->title} برای شما ارسال شده است.";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->instruction->id
        ];
    }
}
