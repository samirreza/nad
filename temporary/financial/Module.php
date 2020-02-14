<?php

namespace nad\temporary\financial;

class Module extends \yii\base\Module
{
    public $title = 'مالی';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\temporary\financial';

    public function init()
    {
        $this->modules = [
            'unit1' => 'nad\temporary\financial\unit1\Module',
            'unit2' => 'nad\temporary\financial\unit2\Module',
            'unit3' => 'nad\temporary\financial\unit3\Module',
        ];
        parent::init();
    }
}
