<?php

namespace nad\factory\support;

class Module extends \yii\base\Module
{
    public $title = 'پشتیبانی';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\factory\support';

    public function init()
    {
        $this->modules = [
            'unit1' => 'nad\factory\support\unit1\Module',
            'unit2' => 'nad\factory\support\unit2\Module',
            'unit3' => 'nad\factory\support\unit3\Module',
        ];
        parent::init();
    }
}
