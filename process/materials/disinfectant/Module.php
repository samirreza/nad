<?php

namespace nad\process\materials\disinfectant;

class Module extends \yii\base\Module
{
    public $title = 'گندزدا';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\materials\disinfectant';

    public function init()
    {
        $this->modules = [
            // 'investigation' => 'nad\process\materials\disinfectant\investigation\Module',
            // 'investigationMonitor' => 'nad\process\materials\disinfectant\investigationMonitor\Module',
            'investigationDesign' => 'nad\process\materials\disinfectant\investigationDesign\Module'
        ];
        parent::init();
    }
}
