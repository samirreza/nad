<?php
namespace nad\engineering\mechanics\device;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'مکانیک  - دستگاه ها';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\mechanics\device';

    public function init()
    {
        $this->modules = [
            'investigationImprovement' => 'nad\engineering\mechanics\device\investigationImprovement\Module',
            'investigationMonitorMethods' => 'nad\engineering\mechanics\device\investigationMonitorMethods\Module',
            'investigationDesign' => 'nad\engineering\mechanics\device\investigationDesign\Module',
            'device' => 'nad\engineering\mechanics\device\device\Module',
        ];

        parent::init();
    }
}
