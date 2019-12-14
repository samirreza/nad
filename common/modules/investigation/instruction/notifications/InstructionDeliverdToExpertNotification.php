<?php

namespace nad\common\modules\investigation\instruction\notifications;

use extensions\notification\Notification;

class InstructionDeliverdToExpertNotification extends Notification
{
    public $instruction;
    public $moduleId = 'instruction';
    public $category = 'دستورالعمل';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "{$this->instruction->title}";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->instruction->id
        ];
    }
}
