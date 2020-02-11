<?php
namespace nad\engineering\instrument\device;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'ابزار دقیق  - دستگاه ها';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\instrument\device';

    public function init()
    {
        $this->modules = [
            'investigationImprovement' => 'nad\engineering\instrument\device\investigationImprovement\Module',
            // 'investigationMonitorMethods' => 'nad\engineering\instrument\device\investigationMonitorMethods\Module',
            // 'investigationDesign' => 'nad\engineering\instrument\device\investigationDesign\Module',
            'device' => 'nad\engineering\instrument\device\device\Module',
        ];

        parent::init();
    }
}
