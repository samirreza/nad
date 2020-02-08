<?php
namespace nad\engineering\construction\device;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'ساختمان  - دستگاه ها';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\construction\device';

    public function init()
    {
        $this->modules = [
            'investigationImprovement' => 'nad\engineering\construction\device\investigationImprovement\Module',
            'investigationMonitorMethods' => 'nad\engineering\construction\device\investigationMonitorMethods\Module',
            'investigationDesign' => 'nad\engineering\construction\device\investigationDesign\Module',
            'device' => 'nad\engineering\construction\device\device\Module',
        ];

        parent::init();
    }
}
