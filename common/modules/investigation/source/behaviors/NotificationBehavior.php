<?php

namespace nad\common\modules\investigation\source\behaviors;

use modules\user\common\models\User;
use nad\common\modules\investigation\source\models\Source;
use nad\common\modules\investigation\source\notifications\SourceAssignNotification;
use nad\common\modules\investigation\source\notifications\SourceDeliverdToExpertNotification;
use nad\common\modules\investigation\source\notifications\DeliveredToManagerNotification;

class NotificationBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            Source::EVENT_SET_EXPERTS => 'notifyExperts',
            Source::EVENT_DELIVERD_TO_MANAGER => 'notifyManager',
            Source::EVENT_DELIVERD_TO_EXPERT => 'notifyExpertsAboutDelivery'
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

    public function notifyExpertsAboutDelivery()
    {
        $users = [];
        $users[] = new User(['id' => $this->owner->createdBy]);
        SourceDeliverdToExpertNotification::create([
            'source' => $this->owner,
            'recipients' => $users,
            'baseViewRoute' => $this->owner->getBaseViewRoute()
        ])->send();
    }

    public function notifyManager()
    {
        //send to all superusers
        $users = User::find()->Where([
            'type' => User::TYPE_SUPERUSER,
            'status' => User::STATUS_ACTIVE
        ])->all();

        DeliveredToManagerNotification::create([
            'source' => $this->owner,
            'recipients' => $users,
            'baseViewRoute' => $this->owner->getBaseViewRoute()
        ])->send();
    }
}
