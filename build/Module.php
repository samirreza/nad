<?php

namespace nad\build;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;

    public function init()
    {
        $this->modules = [
            'material' => 'nad\build\material\Module'
        ];
        parent::init();
    }
}
