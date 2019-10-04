<?php

namespace nad\extensions\comment\notifications;

use extensions\notification\Notification;

class AddCommentNotification extends Notification
{
    public $source;
    public $moduleId = 'source';
    public $category = 'افزودن نظر';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "برای منشا {$this->source->title} نظر تازه ای ثبت شده است.";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->source->id
        ];
    }
}
