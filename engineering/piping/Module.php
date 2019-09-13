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
            'stage' => 'nad\engineering\piping\stage\Module',
            'location' => 'nad\engineering\piping\location\Module', // its name should be "group" (group of documents) but does not matter for now...   
            'document' => 'nad\engineering\piping\document\Module',        
        ];
        parent::init();
    }
}
