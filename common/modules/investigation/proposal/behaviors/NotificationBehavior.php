<?php

namespace nad\common\modules\investigation\proposal\behaviors;

use modules\user\common\models\User;
use nad\common\modules\investigation\proposal\models\Proposal;
use nad\common\modules\investigation\proposal\notifications\ProposalAssignNotification;
use nad\common\modules\investigation\proposal\notifications\DeliveredToManagerNotification;

class NotificationBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            Proposal::EVENT_SET_EXPERT => 'notifyExpert',
            Proposal::EVENT_DELIVERD_TO_MANAGER => 'notifyManager'
        ];
    }

    public function notifyExpert()
    {
        ProposalAssignNotification::create([
            'proposal' => $this->owner,
            'recipients' => $this->owner->reportExpert->user,
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
            'proposal' => $this->owner,
            'recipients' => $users,
            'baseViewRoute' => $this->owner->getBaseViewRoute()
        ])->send();
    }
}
