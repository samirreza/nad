<?php

namespace nad\engineering\equipment\modules\type\notifications;

use extensions\notification\Notification;

class DocumentInsertedNotification extends Notification
{
    public $document;
    public $module = 'equipment';

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return "مدرک {$this->document->title} برای تجهیزات فنی درج شد.";
    }

    public function getCategory()
    {
        return 'درج مدرک';
    }

    public function getRoute()
    {
        return [
            '/engineering/equipment/type/document/index',
            'DocumentSearch[equipmentTypeId]' => $this->document->equipmentType->id,
            'DocumentSearch[title]' => $this->document->title
        ];
    }
}
