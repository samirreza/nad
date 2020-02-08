<?php

namespace nad\process\ird\hydraulic;

class Module extends \yii\base\Module
{
    public $title = 'هیدرولیک';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\ird\hydraulic';

    public function init()
    {
        $this->modules = [
            'investigation' => 'nad\process\ird\hydraulic\investigation\Module',
            'investigationMonitor' => 'nad\process\ird\hydraulic\investigationMonitor\Module',
            'investigationDesign' => 'nad\process\ird\hydraulic\investigationDesign\Module'
        ];
        parent::init();
    }
}
