<?php

namespace nad\common\modules\investigation\common\behaviors;

use yii\db\Query;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\base\InvalidCallException;

class CodeNumeratorBehavior extends Behavior
{
    public $determinativeColumn;
    public $lastCodeNumberColumn = 'lastCodeNumber';
    public $lastCodeDigitNumber = 3;
    public $tableName = null;
    public $condition = null;
    public $conditionParams = [];

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

        $max = 0;
        if(isset($this->tableName) && !empty($this->tableName)){
            // Non-active record style to bypass conditions like: "is_archived"
            $query = new Query();
            $max = $query->select("MAX({$this->lastCodeNumberColumn})")
                    ->from($this->tableName)
                    ->where($this->condition)
                    ->andWhere([
                        $this->determinativeColumn => $this->owner->$determinativeColumn
                    ])
                    ->params($this->conditionParams)
                    ->createCommand()
                    ->queryScalar();
        }else{
            // Active record style to include all conditions like: "is_archived"
            $max = $this->owner::find()
                    ->andWhere([
                        $this->determinativeColumn => $this->owner->$determinativeColumn
                    ])
                    ->max($this->lastCodeNumberColumn);
        }

        return $max;
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
