<?php

namespace nad\process\materials\grs;

class Module extends \yii\base\Module
{
    public $title = 'جی آر اس';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\materials\grs';

    public function init()
    {
        $this->modules = [
            // 'investigation' => 'nad\process\materials\grs\investigation\Module',
            // 'investigationMonitor' => 'nad\process\materials\grs\investigationMonitor\Module',
            'investigationDesign' => 'nad\process\materials\grs\investigationDesign\Module'
        ];
        parent::init();
    }
}
