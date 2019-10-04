<?php

namespace nad\extensions\comment\behaviors;

use nad\extensions\comment\controllers\CommentController;
use nad\extensions\comment\notifications\AddCommentNotification;

class NotificationBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            CommentController::EVENT_INSERT_COMMENT => 'notifyExpertsAndManager',
            CommentController::EVENT_UPDATE_COMMENT => 'notifyExpertsAndManager'
        ];
    }

    public function notifyExpertsAndManager()
    {
        $users = [];
        foreach ($this->owner->getExpertsQuery()->all() as $expert) {
            $users[] = $expert->user;
        }
        AddCommentNotification::create([
            'source' => $this->owner,
            'recipients' => $users,
            'baseViewRoute' => $this->owner->getBaseViewRoute()
        ])->send();
    }
}
