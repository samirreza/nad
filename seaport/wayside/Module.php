<?php

namespace nad\seaport\wayside;

class Module extends \yii\base\Module
{
    public $title = 'واحد بندر';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\seaport\wayside';

    public function init()
    {
        $this->modules = [
            'unit1' => 'nad\seaport\wayside\unit1\Module',
            'unit2' => 'nad\seaport\wayside\unit2\Module',
            'unit3' => 'nad\seaport\wayside\unit3\Module',
        ];
        parent::init();
    }
}
