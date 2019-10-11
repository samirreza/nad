<?php

namespace nad\extensions\comment\behaviors;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use modules\user\common\models\User;
use nad\extensions\comment\notifications\AddCommentNotification;

class NotificationBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'notifyExpertsAndManagers'
        ];
    }

    public function notifyExpertsAndManagers($event)
    {
        $myClass = (new \ReflectionClass($this->owner->modelClassNameFull));
        $myInstance = $myClass->newInstanceWithoutConstructor();
        $sourceModel = $myInstance->findOne($this->owner->modelId);

        $message = '';
        $recipientsUsers = [];

        // send to the author of $sourceModel e.g. منشا
        $recipientsUsers[] = new User(['id' => $sourceModel->createdBy]);

        //send to all superusers
        $superUsers = User::find()->Where([
            'type' => User::TYPE_SUPERUSER,
            'status' => User::STATUS_ACTIVE
        ])->all();
        $recipientsUsers = array_merge($superUsers, $recipientsUsers);

        switch ($this->owner->modelClassName) {
            case 'Source':
                // send to all experts assigned to the $sourceModel
                foreach ($sourceModel->getExpertsQuery()->all() as $expert) {
                    $recipientsUsers[] = $expert->user;
                }
                $message = "برای منشا «{$sourceModel->title}» نظر تازه ای ثبت شده است.";
                break;
            case 'Proposal':
                $message = "برای پروپوزال «{$sourceModel->title}» نظر تازه ای ثبت شده است.";
                break;
            default:
                break;
        }

        // don't send to the author of this comment who has initiated this request
        foreach ($recipientsUsers as $key => $user) {
            if($user->id == Yii::$app->user->id)
                unset($recipientsUsers[$key]);
        }

        // now send
        AddCommentNotification::create([
            'moduleId' => $this->owner->moduleId, // TODO why is this variable needed???
            'message' => $message,
            'source' => $sourceModel,
            'recipients' => $recipientsUsers
        ])->send();
    }
}
