<?php
namespace modules\nad\maker\behaviors;

use creocoder\taggable\TaggableBehavior;

class WorksBehavior extends TaggableBehavior
{
    public $workRelation = 'works';
    public $workValueAttribute = 'title';
    public $workValuesAsArray = false;
    public $workFrequencyAttribute = false;

    public function init()
    {
        parent::init();
        $this->tagValuesAsArray = $this->workValuesAsArray;
        $this->tagRelation = $this->workRelation;
        $this->tagValueAttribute = $this->workValueAttribute;
        $this->tagFrequencyAttribute = $this->workFrequencyAttribute;
    }

    public function getWorks()
    {
        return $this->getTagValues();
    }

    public function getWorksAsArray()
    {
        return $this->getTagValues(true);
    }

    public function setWorks($values)
    {
        return $this->setTagValues($values);
    }

    public function addWorks($values)
    {
        return $this->addTagValues($values);
    }

    public function removeWorks($values)
    {
        return $this->removeTagValues($values);
    }

    public function removeAllWorks()
    {
        return $this->removeAllTagValues();
    }

    public function hasWorks($values)
    {
        return $this->hasTagValues($values);
    }
}
