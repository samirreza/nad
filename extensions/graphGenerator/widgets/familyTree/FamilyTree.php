<?php

namespace nad\extensions\graphGenerator\widgets\familyTree;

use yii\base\InvalidConfigException;

class FamilyTree extends \yii\base\Widget
{

    public function init()
    {       
        parent::init();
    }

    public function run()
    {        
        return $this->render('familyTree');
    }
}
