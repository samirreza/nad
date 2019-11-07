<?php

namespace nad\process\materials\antisediment;

class Module extends \yii\base\Module
{
    public $title = 'ضدرسوب';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\materials\antisediment';

    public function init()
    {
        $this->modules = [
            // 'investigation' => 'nad\process\materials\antisediment\investigation\Module',
            // 'investigationMonitor' => 'nad\process\materials\antisediment\investigationMonitor\Module',
            'investigationDesign' => 'nad\process\materials\antisediment\investigationDesign\Module'
        ];
        parent::init();
    }
}
