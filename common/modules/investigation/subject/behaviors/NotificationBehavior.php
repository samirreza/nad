<?php

namespace nad\common\modules\investigation\subject\behaviors;

use modules\user\common\models\User;
use nad\common\modules\investigation\subject\models\Subject;
use nad\common\modules\investigation\subject\notifications\SubjectAssignNotification;
use nad\common\modules\investigation\subject\notifications\SubjectDeliverdToExpertNotification;
use nad\common\modules\investigation\subject\notifications\DeliveredToManagerNotification;

class NotificationBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            Subject::EVENT_SET_EXPERT => 'notifyExpert',
            Subject::EVENT_DELIVERD_TO_MANAGER => 'notifyManager',
            Subject::EVENT_DELIVERD_TO_EXPERT => 'notifyExpertsAboutDelivery'
        ];
    }

    public function notifyExpert()
    {
        SubjectAssignNotification::create([
            'subject' => $this->owner,
            'recipients' => $this->owner->expert->user,
            'baseViewRoute' => $this->owner->getBaseViewRoute()
        ])->send();
    }

    public function notifyExpertsAboutDelivery()
    {
        $users = [];
        $users[] = new User(['id' => $this->owner->createdBy]);
        SubjectDeliverdToExpertNotification::create([
            'subject' => $this->owner,
            'category' => ($this->owner->isReport() ? 'گزارش' : 'موضوع'),
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
            'subject' => $this->owner,
            'category' => ($this->owner->isReport() ? 'گزارش' : 'موضوع'),
            'recipients' => $users,
            'baseViewRoute' => $this->owner->getBaseViewRoute()
        ])->send();
    }
}
