<?php

namespace nad\temporary\supply;

class Module extends \yii\base\Module
{
    public $title = 'تامین';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\temporary\supply';

    public function init()
    {
        $this->modules = [
            'unit1' => 'nad\temporary\supply\unit1\Module',
            'unit2' => 'nad\temporary\supply\unit2\Module',
            'unit3' => 'nad\temporary\supply\unit3\Module',
        ];
        parent::init();
    }
}
