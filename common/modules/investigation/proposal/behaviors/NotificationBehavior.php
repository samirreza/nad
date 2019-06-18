<?php

namespace nad\common\modules\investigation\proposal\behaviors;

use nad\common\modules\investigation\proposal\models\Proposal;
use nad\common\modules\investigation\proposal\notifications\ProposalAssignNotification;

class NotificationBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            Proposal::EVENT_SET_EXPERT => 'notifyExpert'
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
}
