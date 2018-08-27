<?php
namespace modules\nad\supplier\common\behaviors;

use creocoder\taggable\TaggableBehavior;

class EquipmentsBehavior extends TaggableBehavior
{
    public $equipmentRelation = 'equips';
    public $equipmentValueAttribute = 'title';
    public $equipmentValuesAsArray = false;
    public $equipmentFrequencyAttribute = false;

    public function init()
    {
        parent::init();
        $this->tagValuesAsArray = $this->equipmentValuesAsArray;
        $this->tagRelation = $this->equipmentRelation;
        $this->tagValueAttribute = $this->equipmentValueAttribute;
        $this->tagFrequencyAttribute = $this->equipmentFrequencyAttribute;
    }

    public function getEquipments()
    {
        return $this->getTagValues();
    }

    public function getEquipmentsAsArray()
    {
        return $this->getTagValues(true);
    }

    public function setEquipments($values)
    {
        return $this->setTagValues($values);
    }

    public function addEquipments($values)
    {
        return $this->addTagValues($values);
    }

    public function removeEquipments($values)
    {
        return $this->removeTagValues($values);
    }

    public function removeAllEquipments()
    {
        return $this->removeAllTagValues();
    }

    public function hasEquipments($values)
    {
        return $this->hasTagValues($values);
    }
}
