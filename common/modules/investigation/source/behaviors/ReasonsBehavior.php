<?php

namespace nad\common\modules\investigation\source\behaviors;

use creocoder\taggable\TaggableBehavior;

class ReasonsBehavior extends TaggableBehavior
{
    public $reasonRelation = 'reasonsQuery';
    public $reasonValueAttribute = 'title';
    public $reasonValuesAsArray = false;
    public $reasonFrequencyAttribute = false;

    public function init()
    {
        $this->tagValuesAsArray = $this->reasonValuesAsArray;
        $this->tagRelation = $this->reasonRelation;
        $this->tagValueAttribute = $this->reasonValueAttribute;
        $this->tagFrequencyAttribute = $this->reasonFrequencyAttribute;
        parent::init();
    }

    public function getReasons()
    {
        return $this->getTagValues();
    }

    public function getReasonsAsArray()
    {
        return $this->getTagValues(true);
    }

    public function setReasons($values)
    {
        return $this->setTagValues($values);
    }

    public function addReasons($values)
    {
        return $this->addTagValues($values);
    }

    public function removeReasons($values)
    {
        return $this->removeTagValues($values);
    }

    public function removeAllReasons()
    {
        return $this->removeAllTagValues();
    }

    public function hasReasons($values)
    {
        return $this->hasTagValues($values);
    }
}
