<?php

namespace nad\common\modules\investigation\source\notifications;

use extensions\notification\Notification;

class SourceDeliverdToExpertNotification extends Notification
{
    public $source;
    public $moduleId = 'source';
    public $category = 'منشا';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "{$this->source->title}";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->source->id
        ];
    }
}
