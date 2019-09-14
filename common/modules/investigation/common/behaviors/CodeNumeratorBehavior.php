<?php

namespace nad\common\modules\investigation\common\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\base\InvalidCallException;

class CodeNumeratorBehavior extends Behavior
{
    public $determinativeColumn;
    public $lastCodeNumberColumn = 'lastCodeNumber';
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
            ActiveRecord::EVENT_BEFORE_INSERT => 'setLastCodeNumber',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'setLastCodeNumber'
        ];
    }

    public function setLastCodeNumber()
    {
        if (
            $this->owner->isNewRecord ||
            $this->owner->oldAttributes[$this->determinativeColumn] != $this->owner->{$this->determinativeColumn}
        ) {
            $this->owner->{$this->lastCodeNumberColumn} = $this->owner->getLastInsertedCodeNumber() + 1;
        }
    }

    public function getLastInsertedCodeNumber()
    {
        $determinativeColumn = $this->determinativeColumn;
        return $this->owner::find()
            ->andWhere([
                $this->determinativeColumn => $this->owner->$determinativeColumn
            ])
            ->max($this->lastCodeNumberColumn);
    }

    public function getNumberPartOfUniqueCode()
    {
        return str_pad(
            $this->owner->{$this->lastCodeNumberColumn},
            $this->lastCodeDigitNumber,
            '0',
            STR_PAD_LEFT
        );
    }
}
