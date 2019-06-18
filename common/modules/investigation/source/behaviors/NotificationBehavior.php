<?php

namespace nad\common\modules\investigation\source\behaviors;

use nad\common\modules\investigation\source\models\Source;
use nad\common\modules\investigation\source\notifications\SourceAssignNotification;

class NotificationBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            Source::EVENT_SET_EXPERTS => 'notifyExperts'
        ];
    }

    public function notifyExperts()
    {
        $users = [];
        foreach ($this->owner->getExpertsQuery()->all() as $expert) {
            $users[] = $expert->user;
        }
        SourceAssignNotification::create([
            'source' => $this->owner,
            'recipients' => $users,
            'baseViewRoute' => $this->owner->getBaseViewRoute()
        ])->send();
    }
}
