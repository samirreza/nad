<?php

namespace nad\process\ird\wastewater;

class Module extends \yii\base\Module
{
    public $title = 'پساب';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\ird\wastewater';

    public function init()
    {
        $this->modules = [
            'investigation' => 'nad\process\ird\wastewater\investigation\Module',
            'investigationMonitor' => 'nad\process\ird\wastewater\investigationMonitor\Module',
            'investigationDesign' => 'nad\process\ird\wastewater\investigationDesign\Module'
        ];
        parent::init();
    }
}
