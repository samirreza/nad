<?php
namespace nad\engineering\geotechnics\device;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'ژئوتکنیک  - دستگاه ها';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\geotechnics\device';

    public function init()
    {
        $this->modules = [
            'investigationImprovement' => 'nad\engineering\geotechnics\device\investigationImprovement\Module',
            'investigationMonitorMethods' => 'nad\engineering\geotechnics\device\investigationMonitorMethods\Module',
            'investigationDesign' => 'nad\engineering\geotechnics\device\investigationDesign\Module',
            'device' => 'nad\engineering\geotechnics\device\device\Module',
        ];

        parent::init();
    }
}
