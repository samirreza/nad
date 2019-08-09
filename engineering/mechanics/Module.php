<?php

namespace nad\engineering\mechanics;

class Module extends \yii\base\Module
{
    public $title = 'مکانیک';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\mechanics';

    public function init()
    {                
        $this->modules = [
            'location' => 'nad\engineering\mechanics\location\Module',
            'stage' => 'nad\engineering\mechanics\stage\Module',        
            'investigation' => 'nad\engineering\mechanics\investigation\Module', 
        ];
        parent::init();
    }
}
