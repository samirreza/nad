<?php

namespace nad\engineering\well;

class Module extends \yii\base\Module
{
    public $title = 'چاه';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\well';

    public function init()
    {                
        $this->modules = [
            'location' => 'nad\engineering\well\location\Module',
            'stage' => 'nad\engineering\well\stage\Module',        
        ];
        parent::init();
    }
}
