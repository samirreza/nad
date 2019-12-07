<?php
namespace nad\engineering\piping\device;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'لوله کشی  - دستگاه ها';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\piping\device';

    public function init()
    {
        $this->modules = [
            'investigationImprovement' => 'nad\engineering\piping\device\investigationImprovement\Module',
            'investigationMonitorMethods' => 'nad\engineering\piping\device\investigationMonitorMethods\Module',
            'investigationDesign' => 'nad\engineering\piping\device\investigationDesign\Module',
            'device' => 'nad\engineering\piping\device\device\Module',
        ];

        parent::init();
    }
}
