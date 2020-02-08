<?php
namespace nad\engineering\control\device;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'کنترل  - دستگاه ها';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\control\device';

    public function init()
    {
        $this->modules = [
            'investigationImprovement' => 'nad\engineering\control\device\investigationImprovement\Module',
            'investigationMonitorMethods' => 'nad\engineering\control\device\investigationMonitorMethods\Module',
            'investigationDesign' => 'nad\engineering\control\device\investigationDesign\Module',
            'device' => 'nad\engineering\control\device\device\Module',
        ];

        parent::init();
    }
}
