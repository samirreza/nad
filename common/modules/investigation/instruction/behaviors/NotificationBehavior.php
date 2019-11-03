<?php

namespace nad\common\modules\investigation\instruction\behaviors;

use modules\user\common\models\User;
use nad\common\modules\investigation\instruction\models\Instruction;
use nad\common\modules\investigation\instruction\notifications\InstructionAssignNotification;
use nad\common\modules\investigation\instruction\notifications\InstructionDeliverdToExpertNotification;
use nad\common\modules\investigation\instruction\notifications\DeliveredToManagerNotification;

class NotificationBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            Instruction::EVENT_SET_EXPERT => 'notifyExpert',
            Instruction::EVENT_DELIVERD_TO_MANAGER => 'notifyManager',
            Instruction::EVENT_DELIVERD_TO_EXPERT => 'notifyExpertsAboutDelivery'
        ];
    }

    public function notifyExpert()
    {
        InstructionAssignNotification::create([
            'instruction' => $this->owner,
            'recipients' => $this->owner->expert->user,
            'baseViewRoute' => $this->owner->getBaseViewRoute()
        ])->send();
    }

    public function notifyExpertsAboutDelivery()
    {
        $users = [];
        $users[] = new User(['id' => $this->owner->createdBy]);
        InstructionDeliverdToExpertNotification::create([
            'instruction' => $this->owner,
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
            'instruction' => $this->owner,
            'recipients' => $users,
            'baseViewRoute' => $this->owner->getBaseViewRoute()
        ])->send();
    }
}
