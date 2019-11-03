<?php

namespace nad\common\modules\investigation\report\behaviors;

use modules\user\common\models\User;
use nad\common\modules\investigation\report\models\Report;
use nad\common\modules\investigation\report\notifications\ReportAssignNotification;
use nad\common\modules\investigation\report\notifications\ReportDeliverdToExpertNotification;
use nad\common\modules\investigation\report\notifications\DeliveredToManagerNotification;

class NotificationBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            Report::EVENT_SET_EXPERT => 'notifyExpert',
            Report::EVENT_DELIVERD_TO_MANAGER => 'notifyManager',
            Report::EVENT_DELIVERD_TO_EXPERT => 'notifyExpertsAboutDelivery'
        ];
    }

    public function notifyExpert()
    {
        ReportAssignNotification::create([
            'report' => $this->owner,
            'recipients' => $this->owner->expert->user,
            'baseViewRoute' => $this->owner->getBaseViewRoute()
        ])->send();
    }

    public function notifyExpertsAboutDelivery()
    {
        $users = [];
        $users[] = new User(['id' => $this->owner->createdBy]);
        ReportDeliverdToExpertNotification::create([
            'report' => $this->owner,
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
            'report' => $this->owner,
            'recipients' => $users,
            'baseViewRoute' => $this->owner->getBaseViewRoute()
        ])->send();
    }
}
