<?php

namespace nad\process\ird\graphene;

class Module extends \yii\base\Module
{
    public $title = 'گرافن';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\ird\graphene';

    public function init()
    {
        $this->modules = [
            'investigation' => 'nad\process\ird\graphene\investigation\Module',
            'investigationMonitor' => 'nad\process\ird\graphene\investigationMonitor\Module',
            'investigationDesign' => 'nad\process\ird\graphene\investigationDesign\Module'
        ];
        parent::init();
    }
}
