<?php

namespace nad\common\modules\investigation\method\behaviors;

use modules\user\common\models\User;
use nad\common\modules\investigation\method\models\Method;
use nad\common\modules\investigation\method\notifications\MethodAssignNotification;
use nad\common\modules\investigation\method\notifications\MethodDeliverdToExpertNotification;
use nad\common\modules\investigation\method\notifications\DeliveredToManagerNotification;

class NotificationBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            Method::EVENT_SET_EXPERT => 'notifyExpert',
            Method::EVENT_DELIVERD_TO_MANAGER => 'notifyManager',
            Method::EVENT_DELIVERD_TO_EXPERT => 'notifyExpertsAboutDelivery'
        ];
    }

    public function notifyExpert()
    {
        MethodAssignNotification::create([
            'method' => $this->owner,
            'recipients' => $this->owner->expert->user,
            'baseViewRoute' => $this->owner->getBaseViewRoute()
        ])->send();
    }

    public function notifyExpertsAboutDelivery()
    {
        $users = [];
        $users[] = new User(['id' => $this->owner->createdBy]);
        MethodDeliverdToExpertNotification::create([
            'method' => $this->owner,
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
            'method' => $this->owner,
            'recipients' => $users,
            'baseViewRoute' => $this->owner->getBaseViewRoute()
        ])->send();
    }
}
