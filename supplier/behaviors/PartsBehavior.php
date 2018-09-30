<?php
namespace modules\nad\supplier\behaviors;

use creocoder\taggable\TaggableBehavior;

class PartsBehavior extends TaggableBehavior
{
    public $partRelation = 'partsRelation';
    public $partValueAttribute = 'title';
    public $partValuesAsArray = false;
    public $partFrequencyAttribute = false;

    public function init()
    {
        parent::init();
        $this->tagValuesAsArray = $this->partValuesAsArray;
        $this->tagRelation = $this->partRelation;
        $this->tagValueAttribute = $this->partValueAttribute;
        $this->tagFrequencyAttribute = $this->partFrequencyAttribute;
    }

    public function getParts()
    {
        return $this->getTagValues();
    }

    public function getPartsAsArray()
    {
        return $this->getTagValues(true);
    }

    public function setParts($values)
    {
        return $this->setTagValues($values);
    }

    public function addParts($values)
    {
        return $this->addTagValues($values);
    }

    public function removeParts($values)
    {
        return $this->removeTagValues($values);
    }

    public function removeAllParts()
    {
        return $this->removeAllTagValues();
    }

    public function hasParts($values)
    {
        return $this->hasTagValues($values);
    }
}
