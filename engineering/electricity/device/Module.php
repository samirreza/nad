<?php
namespace nad\engineering\electricity\device;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'برق  - دستگاه ها';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\electricity\device';

    public function init()
    {
        $this->modules = [
            'investigationImprovement' => 'nad\engineering\electricity\device\investigationImprovement\Module',
            // 'investigationMonitorMethods' => 'nad\engineering\electricity\device\investigationMonitorMethods\Module',
            // 'investigationDesign' => 'nad\engineering\electricity\device\investigationDesign\Module',
            'device' => 'nad\engineering\electricity\device\device\Module',
        ];

        parent::init();
    }
}
