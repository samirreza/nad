<?php

namespace nad\temporary\administrative;

class Module extends \yii\base\Module
{
    public $title = 'اداری';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\temporary\administrative';

    public function init()
    {
        $this->modules = [
            'unit1' => 'nad\temporary\administrative\unit1\Module',
            'unit2' => 'nad\temporary\administrative\unit2\Module',
            'unit3' => 'nad\temporary\administrative\unit3\Module',
        ];
        parent::init();
    }
}
