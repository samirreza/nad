<?php

namespace nad\process\ird\heattransfer;

class Module extends \yii\base\Module
{
    public $title = 'انتقال حرارت';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\ird\heattransfer';

    public function init()
    {
        $this->modules = [
            'investigation' => 'nad\process\ird\heattransfer\investigation\Module',
            'investigationMonitor' => 'nad\process\ird\heattransfer\investigationMonitor\Module',
            'investigationDesign' => 'nad\process\ird\heattransfer\investigationDesign\Module'
        ];
        parent::init();
    }
}
