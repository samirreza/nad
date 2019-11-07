<?php

namespace nad\process\materials\antimicrobial;

class Module extends \yii\base\Module
{
    public $title = 'ضدمیکروب';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\materials\antimicrobial';

    public function init()
    {
        $this->modules = [
            // 'investigation' => 'nad\process\materials\antimicrobial\investigation\Module',
            // 'investigationMonitor' => 'nad\process\materials\antimicrobial\investigationMonitor\Module',
            'investigationDesign' => 'nad\process\materials\antimicrobial\investigationDesign\Module'
        ];
        parent::init();
    }
}
