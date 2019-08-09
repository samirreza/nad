<?php

namespace nad\engineering\piping;

class Module extends \yii\base\Module
{
    public $title = 'لوله کشی';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\piping';

    public function init()
    {                
        $this->modules = [
            'location' => 'nad\engineering\piping\location\Module',
            'stage' => 'nad\engineering\piping\stage\Module',        
            'investigation' => 'nad\engineering\piping\investigation\Module', 
        ];
        parent::init();
    }
}
