<?php

namespace nad\common\modules\investigation\proposal\notifications;

use extensions\notification\Notification;

class ProposalDeliverdToExpertNotification extends Notification
{
    public $proposal;
    public $moduleId = 'proposal';
    public $category = 'پروپوزال نیازمند اصلاح';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "پروپوزال «{$this->proposal->title}» جهت اصلاح مجددا به شما ارسال شده است.";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->proposal->id
        ];
    }
}
