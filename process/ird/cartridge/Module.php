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
            'investigation' => 'nad\process\ird\cartridge\investigation\Module',
            'investigationMonitor' => 'nad\process\ird\cartridge\investigationMonitor\Module',
            'investigationDesign' => 'nad\process\ird\cartridge\investigationDesign\Module',
            'payesh' => 'nad\process\ird\cartridge\payesh\Module',
        ];
        parent::init();
    }
}
