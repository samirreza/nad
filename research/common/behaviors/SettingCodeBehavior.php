<?php

namespace nad\research\common\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\base\InvalidCallException;

class SettingCodeBehavior extends Behavior
{
    public $determinativeColumn;
    public $lastCodeColumn = 'lastCode';
    public $lastCodeDigitNumber = 3;

    public function init()
    {
        if (empty($this->determinativeColumn)) {
            throw new InvalidCallException('determinativeColumn must be set.');
        }
        parent::init();
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'setLastCode'
        ];
    }

    public function setLastCode()
    {
        $this->owner->{$this->lastCodeColumn} = $this->getLastInsertedCode() + 1;
    }

    public function getLastInsertedCode()
    {
        $determinativeColumn = $this->determinativeColumn;
        return $this->owner::find()
            ->andWhere([
                $this->determinativeColumn => $this->owner->$determinativeColumn
            ])
            ->max($this->lastCodeColumn);
    }

    public function getLastCodePart()
    {
        return str_pad(
            $this->owner->{$this->lastCodeColumn},
            $this->lastCodeDigitNumber,
            '0',
            STR_PAD_LEFT
        );
    }
}
