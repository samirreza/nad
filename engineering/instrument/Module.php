<?php

namespace nad\engineering\instrument;

class Module extends \yii\base\Module
{
    public $title = 'ابزار دقیق';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\instrument';

    public function init()
    {                
        $this->modules = [
            'location' => 'nad\engineering\instrument\location\Module',
            'stage' => 'nad\engineering\instrument\stage\Module',        
        ];
        parent::init();
    }
}
