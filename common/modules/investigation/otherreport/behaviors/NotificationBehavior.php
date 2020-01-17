<?php

namespace nad\common\modules\investigation\otherreport\behaviors;

use modules\user\common\models\User;
use nad\common\modules\investigation\otherreport\models\Otherreport;
use nad\common\modules\investigation\otherreport\notifications\OtherreportAssignNotification;
use nad\common\modules\investigation\otherreport\notifications\OtherreportDeliverdToExpertNotification;
use nad\common\modules\investigation\otherreport\notifications\DeliveredToManagerNotification;

class NotificationBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            Otherreport::EVENT_DELIVERD_TO_MANAGER => 'notifyManager',
            Otherreport::EVENT_DELIVERD_TO_EXPERT => 'notifyExpertsAboutDelivery'
        ];
    }

    public function notifyExpertsAboutDelivery()
    {
        $users = [];
        $users[] = new User(['id' => $this->owner->createdBy]);
        OtherreportDeliverdToExpertNotification::create([
            'otherreport' => $this->owner,
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
            'otherreport' => $this->owner,
            'recipients' => $users,
            'baseViewRoute' => $this->owner->getBaseViewRoute()
        ])->send();
    }
}
