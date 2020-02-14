<?php

namespace nad\build\equipment;

class Module extends \yii\base\Module
{
    public $title = 'تجهیزات';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\build\equipment';

    public function init()
    {
        $this->modules = [
            'unit1' => 'nad\build\equipment\unit1\Module',
            'unit2' => 'nad\build\equipment\unit2\Module',
            'unit3' => 'nad\build\equipment\unit3\Module',
        ];
        parent::init();
    }
}
