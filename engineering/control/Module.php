<?php

namespace nad\engineering\control;

class Module extends \yii\base\Module
{
    public $title = 'کنترل';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\control';

    public function init()
    {                
        $this->modules = [
            'location' => 'nad\engineering\control\location\Module',
            'stage' => 'nad\engineering\control\stage\Module',        
            'investigation' => 'nad\engineering\control\investigation\Module',      
        ];
        parent::init();
    }
}
