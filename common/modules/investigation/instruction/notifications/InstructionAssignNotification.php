<?php

namespace nad\common\modules\investigation\instruction\notifications;

use extensions\notification\Notification;
use nad\common\modules\investigation\instruction\models\InstructionCommon;

class InstructionAssignNotification extends Notification
{
    public $instruction;
    public $moduleId = 'instruction';
    public $category = 'نگارش';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        switch ($this->instruction->status) {
            case InstructionCommon::STATUS_IN_NEXT_STEP :
                $this->category .= ' منشا';
                break;
            // case InstructionCommon::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION :
            //     $this->category .= ' دستورالعمل';
            //     break;
            // case InstructionCommon::STATUS_IN_NEXT_STEP_FOR_SOURCE_INSTRUCTION :
            //     $this->category .= ' منشا/دستورالعمل';
            //     break;
            default:
                break;
        }
        return "دستورالعمل «{$this->instruction->title}» برای {$this->category} به شما تحویل داده شد.";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->instruction->id
        ];
    }
}
