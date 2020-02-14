<?php

namespace nad\factory\build;

class Module extends \yii\base\Module
{
    public $title = 'احداث';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\factory\build';

    public function init()
    {
        $this->modules = [
            'unit1' => 'nad\factory\build\unit1\Module',
            'unit2' => 'nad\factory\build\unit2\Module',
            'unit3' => 'nad\factory\build\unit3\Module',
        ];
        parent::init();
    }
}
