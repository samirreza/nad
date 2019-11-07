<?php

namespace nad\process\materials\lacquer;

class Module extends \yii\base\Module
{
    public $title = 'لاک بیرنگ';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\materials\lacquer';

    public function init()
    {
        $this->modules = [
            // 'investigation' => 'nad\process\materials\lacquer\investigation\Module',
            // 'investigationMonitor' => 'nad\process\materials\lacquer\investigationMonitor\Module',
            'investigationDesign' => 'nad\process\materials\lacquer\investigationDesign\Module'
        ];
        parent::init();
    }
}
