<?php

namespace nad\coordination;

class Module extends \yii\base\Module
{
    public $title = 'هماهنگی';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\coordination';

    public function init()
    {
        $this->modules = [
            'payesh' => 'nad\coordination\payesh\Module',
        ];
        parent::init();
    }
}
