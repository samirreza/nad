<?php

namespace nad\common\modules\investigation\proposal\behaviors;

use creocoder\taggable\TaggableBehavior;

class PartnersBehavior extends TaggableBehavior
{
    public $partnerRelation = 'partnersQuery';
    public $partnerValueAttribute = 'id';
    public $partnerValuesAsArray = false;
    public $partnerFrequencyAttribute = false;

    public function init()
    {
        $this->tagValuesAsArray = $this->partnerValuesAsArray;
        $this->tagRelation = $this->partnerRelation;
        $this->tagValueAttribute = $this->partnerValueAttribute;
        $this->tagFrequencyAttribute = $this->partnerFrequencyAttribute;
        parent::init();
    }

    public function getPartners()
    {
        return $this->getTagValues();
    }

    public function getPartnersAsArray()
    {
        return $this->getTagValues(true);
    }

    public function setPartners($values)
    {
        return $this->setTagValues($values);
    }

    public function addPartners($values)
    {
        return $this->addTagValues($values);
    }

    public function removePartners($values)
    {
        return $this->removeTagValues($values);
    }

    public function removeAllPartners()
    {
        return $this->removeAllTagValues();
    }

    public function hasPartners($values)
    {
        return $this->hasTagValues($values);
    }

    public function getPartnerFullNamesAsString()
    {
        $output = '';
        foreach ($this->owner->partnersQuery as $partners) {
            $output .= $partners->user->fullName . ', ';
        }
        return rtrim($output, ', ');
    }
}
