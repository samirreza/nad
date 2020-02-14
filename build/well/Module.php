<?php

namespace nad\build\well;

class Module extends \yii\base\Module
{
    public $title = 'چاه';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\build\well';

    public function init()
    {
        $this->modules = [
            'unit1' => 'nad\build\well\unit1\Module',
            'unit2' => 'nad\build\well\unit2\Module',
            'unit3' => 'nad\build\well\unit3\Module',
        ];
        parent::init();
    }
}
