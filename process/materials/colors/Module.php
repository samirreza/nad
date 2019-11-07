<?php

namespace nad\process\materials\colors;

class Module extends \yii\base\Module
{
    public $title = 'رنگ ها';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\materials\colors';

    public function init()
    {
        $this->modules = [
            // 'investigation' => 'nad\process\materials\colors\investigation\Module',
            // 'investigationMonitor' => 'nad\process\materials\colors\investigationMonitor\Module',
            'investigationDesign' => 'nad\process\materials\colors\investigationDesign\Module'
        ];
        parent::init();
    }
}
