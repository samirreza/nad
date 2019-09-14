<?php

namespace nad\research;

class Module extends \yii\base\Module
{
    public function init()
    {
        $this->modules = [
            'investigation' => 'nad\research\investigation\Module',
            'control' => 'nad\research\control\Module'
        ];
        parent::init();
    }
}
