<?php

namespace nad\process\materials\coagulant;

class Module extends \yii\base\Module
{
    public $title = 'منعقدکننده';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\materials\coagulant';

    public function init()
    {
        $this->modules = [
            // 'investigation' => 'nad\process\materials\coagulant\investigation\Module',
            // 'investigationMonitor' => 'nad\process\materials\coagulant\investigationMonitor\Module',
            'investigationDesign' => 'nad\process\materials\coagulant\investigationDesign\Module'
        ];
        parent::init();
    }
}
