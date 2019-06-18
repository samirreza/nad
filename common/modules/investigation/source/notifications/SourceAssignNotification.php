<?php

namespace nad\common\modules\investigation\source\notifications;

use extensions\notification\Notification;

class SourceAssignNotification extends Notification
{
    public $source;
    public $moduleId = 'source';
    public $category = 'نگارش پروپوزال';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "منشا {$this->source->title} برای نگارش پروپوزال به شما تحویل داده شد.";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->source->id
        ];
    }
}
