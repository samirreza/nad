<?php

namespace nad\common\modules\investigation\source\notifications;

use extensions\notification\Notification;

class SourceDeliverdToExpertNotification extends Notification
{
    public $source;
    public $moduleId = 'source';
    public $category = 'منشا نیازمند اصلاح';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "منشا «{$this->source->title}» جهت اصلاح مجددا به شما ارسال شده است.";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->source->id
        ];
    }
}
