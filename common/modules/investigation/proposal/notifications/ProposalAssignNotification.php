<?php

namespace nad\common\modules\investigation\proposal\notifications;

use extensions\notification\Notification;

class ProposalAssignNotification extends Notification
{
    public $proposal;
    public $moduleId = 'proposal';
    public $category = 'نگارش گزارش';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "پروپوزال {$this->proposal->title} برای نگارش گزارش به شما تحویل داده شد.";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->proposal->id
        ];
    }
}
