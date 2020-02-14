<?php

namespace nad\factory\production;

class Module extends \yii\base\Module
{
    public $title = 'تولید';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\factory\production';

    public function init()
    {
        $this->modules = [
            'unit1' => 'nad\factory\production\unit1\Module',
            'unit2' => 'nad\factory\production\unit2\Module',
            'unit3' => 'nad\factory\production\unit3\Module',
        ];
        parent::init();
    }
}
