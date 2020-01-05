<?php

namespace nad\common\modules\investigation\source\behaviors;

use creocoder\taggable\TaggableBehavior;

class ExpertsBehavior extends TaggableBehavior
{
    public $expertRelation = 'expertsQuery';
    public $expertValueAttribute = 'id';
    public $expertValuesAsArray = false;
    public $expertFrequencyAttribute = false;

    public function init()
    {
        $this->tagValuesAsArray = $this->expertValuesAsArray;
        $this->tagRelation = $this->expertRelation;
        $this->tagValueAttribute = $this->expertValueAttribute;
        $this->tagFrequencyAttribute = $this->expertFrequencyAttribute;
        parent::init();
    }

    public function getExperts()
    {
        return $this->getTagValues();
    }

    public function getExpertsAsArray()
    {
        return $this->getTagValues(true);
    }

    public function setExperts($values)
    {
        return $this->setTagValues($values);
    }

    public function addExperts($values)
    {
        return $this->addTagValues($values);
    }

    public function removeExperts($values)
    {
        return $this->removeTagValues($values);
    }

    public function removeAllExperts()
    {
        return $this->removeAllTagValues();
    }

    public function hasExperts($values)
    {
        return $this->hasTagValues($values);
    }

    public function getExpertFullNamesAsString()
    {
        $output = '';
        $getFunction = 'get' . ucfirst($this->expertRelation);
        foreach ($this->owner->$getFunction()->all() as $expert) {
            $output .= $expert->user->fullName . ', ';
        }
        return rtrim($output, ', ');
    }

    public function hasAnyExpert()
    {
        return !empty($this->getExperts());
    }
}
