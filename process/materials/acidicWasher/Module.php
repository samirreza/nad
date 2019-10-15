<?php

namespace nad\process\materials\acidicWasher;

class Module extends \yii\base\Module
{
    public $title = 'شوینده اسیدی';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\materials\acidicWasher';

    public function init()
    {
        $this->modules = [
            'investigation' => 'nad\process\materials\acidicWasher\investigation\Module',
            'investigationMonitor' => 'nad\process\materials\acidicWasher\investigationMonitor\Module'
        ];
        parent::init();
    }
}
