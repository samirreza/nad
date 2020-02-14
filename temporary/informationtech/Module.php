<?php

namespace nad\temporary\informationtech;

class Module extends \yii\base\Module
{
    public $title = 'آی تی';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\temporary\informationtech';

    public function init()
    {
        $this->modules = [
            'unit1' => 'nad\temporary\informationtech\unit1\Module',
            'unit2' => 'nad\temporary\informationtech\unit2\Module',
            'unit3' => 'nad\temporary\informationtech\unit3\Module',
        ];
        parent::init();
    }
}
