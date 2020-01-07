<?php

namespace nad\process\ird\microbial;

class Module extends \yii\base\Module
{
    public $title = 'میکروبیولوژی';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\ird\microbial';

    public function init()
    {
        $this->modules = [
            'investigation' => 'nad\process\ird\microbial\investigation\Module',
            'investigationMonitor' => 'nad\process\ird\microbial\investigationMonitor\Module',
            'investigationDesign' => 'nad\process\ird\microbial\investigationDesign\Module'
        ];
        parent::init();
    }
}
