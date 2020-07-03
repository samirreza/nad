<?php

namespace nad\general;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;

    public function init()
    {
        $this->modules = [
        ];
        parent::init();
    }
}
