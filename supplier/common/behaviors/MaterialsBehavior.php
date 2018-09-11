<?php
namespace modules\nad\supplier\common\behaviors;

use creocoder\taggable\TaggableBehavior;

class MaterialsBehavior extends TaggableBehavior
{
    public $materialRelation = 'matTypes';
    public $materialValueAttribute = 'title';
    public $materialValuesAsArray = false;
    public $materialFrequencyAttribute = false;

    public function init()
    {
        parent::init();
        $this->tagValuesAsArray = $this->materialValuesAsArray;
        $this->tagRelation = $this->materialRelation;
        $this->tagValueAttribute = $this->materialValueAttribute;
        $this->tagFrequencyAttribute = $this->materialFrequencyAttribute;
    }

    public function getMaterials()
    {
        return $this->getTagValues();
    }

    public function getMaterialsAsArray()
    {
        return $this->getTagValues(true);
    }

    public function setMaterials($values)
    {
        return $this->setTagValues($values);
    }

    public function addMaterials($values)
    {
        return $this->addTagValues($values);
    }

    public function removeMaterials($values)
    {
        return $this->removeTagValues($values);
    }

    public function removeAllMaterials()
    {
        return $this->removeAllTagValues();
    }

    public function hasMaterials($values)
    {
        return $this->hasTagValues($values);
    }
}
