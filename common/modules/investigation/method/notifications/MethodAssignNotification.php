<?php

namespace nad\common\modules\investigation\method\notifications;

use extensions\notification\Notification;
use nad\common\modules\investigation\method\models\MethodCommon;

class MethodAssignNotification extends Notification
{
    public $method;
    public $moduleId = 'method';
    public $category = 'نگارش';
    public $baseViewRoute;

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        switch ($this->method->status) {
            case MethodCommon::STATUS_IN_NEXT_STEP :
                $this->category .= ' منشا';
                break;
            case MethodCommon::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION :
                $this->category .= ' دستورالعمل';
                break;
            case MethodCommon::STATUS_IN_NEXT_STEP_FOR_SOURCE_INSTRUCTION :
                $this->category .= ' منشا/دستورالعمل';
                break;
            default:
                break;
        }
        return "روش «{$this->method->title}» برای {$this->category} به شما تحویل داده شد.";
    }

    public function getRoute()
    {
        return [
            $this->baseViewRoute,
            'id' => $this->method->id
        ];
    }
}
