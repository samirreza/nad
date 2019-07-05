<?php

namespace nad\process\ird\cartridge;

class Module extends \yii\base\Module
{
    public $title = 'کارتریج';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\ird\cartridge';

    public function init()
    {
        $this->modules = [
            'investigation' => 'nad\process\ird\cartridge\investigation\Module'
        ];
        parent::init();
    }
}
