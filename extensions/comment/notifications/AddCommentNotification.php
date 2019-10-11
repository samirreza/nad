<?php

namespace nad\extensions\comment\notifications;

use yii\base\InvalidConfigException;
use extensions\notification\Notification;

class AddCommentNotification extends Notification
{
    public $moduleId;
    public $message = '';
    public $category = 'افزودن نظر';
    public $source;

    public function init()
    {
        if (!isset($this->source)) {
            throw new InvalidConfigException('source property must be set.');
        }
        parent::init();
    }

    public function getChannels()
    {
        return ['screen'];
    }

    public function getTitle()
    {
        return $this->message;
    }

    public function getRoute()
    {
        return [
            $this->source->getBaseViewRoute(),
            'id' => $this->source->id
        ];
    }
}
