<?php

namespace nad\build\construction;

class Module extends \yii\base\Module
{
    public $title = 'ساختمان';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\build\construction';

    public function init()
    {
        $this->modules = [
            'unit1' => 'nad\build\construction\unit1\Module',
            'unit2' => 'nad\build\construction\unit2\Module',
            'unit3' => 'nad\build\construction\unit3\Module',
        ];
        parent::init();
    }
}
