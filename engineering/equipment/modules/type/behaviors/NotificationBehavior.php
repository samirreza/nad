<?php

namespace nad\engineering\equipment\modules\type\behaviors;

use nad\engineering\equipment\modules\type\models\Document;
use nad\engineering\equipment\modules\type\notifications\DocumentInsertedNotification;

class NotificationBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            Document::EVENT_DOCUMENT_INSERTED => 'documentInserted'
        ];
    }

    public function documentInserted()
    {
        DocumentInsertedNotification::create([
            'document' => $this->owner,
            'permissions' => ['manager']
        ])->send();
    }
}
