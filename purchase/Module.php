<?php

namespace nad\purchase;

class Module extends \yii\base\Module
{
    public $title = 'خرید';

    public function init()
    {
        $this->modules = [];
        parent::init();
    }
}
