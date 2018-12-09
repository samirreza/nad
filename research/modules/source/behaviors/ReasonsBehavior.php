<?php

namespace nad\research\modules\source\behaviors;

use creocoder\taggable\TaggableBehavior;

class ReasonsBehavior extends TaggableBehavior
{
    public $catRelation = 'reasonsQuery';
    public $catValueAttribute = 'title';
    public $catValuesAsArray = false;
    public $catFrequencyAttribute = false;

    public function init()
    {
        $this->tagValuesAsArray = $this->catValuesAsArray;
        $this->tagRelation = $this->catRelation;
        $this->tagValueAttribute = $this->catValueAttribute;
        $this->tagFrequencyAttribute = $this->catFrequencyAttribute;
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
