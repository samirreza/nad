<?php

namespace nad\purchase\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\base\InvalidConfigException;

class PreventDeleteBehavior extends Behavior
{
    public $relations;

    public function init()
    {
        if (!isset($this->relations)) {
            throw new InvalidConfigException("relations attribute must be set");
        }
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_DELETE => 'canDelete'
        ];
    }

    public function canDelete($event)
    {
        foreach ($this->relations as $relation) {
            $method = $relation['relationMethod'];
            $relatedNextForm = $this->owner->$method()->one();
            if (isset($relatedNextForm) && !empty($relatedNextForm)) {
                $formName = $relatedNextForm->title;
                $this->owner->addError(
                    'id',
                    "فرم انتخاب شده به دلیل اتصال به فرم «{$formName}» غیرقابل حذف می باشد."
                );
                $event->isValid = false;
                $event->handled = true;
            }
        }
        return true;
    }
}
