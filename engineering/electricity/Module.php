<?php

namespace nad\engineering\electricity;

class Module extends \yii\base\Module
{
    public $title = 'لوله کشی';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\electricity';

    public function init()
    {                
        $this->modules = [
            'location' => 'nad\engineering\electricity\location\Module',
            'stage' => 'nad\engineering\electricity\stage\Module',        
            'investigation' => 'nad\engineering\electricity\investigation\Module', 
        ];
        parent::init();
    }
}
