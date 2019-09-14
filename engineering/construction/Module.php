<?php

namespace nad\engineering\construction;

class Module extends \yii\base\Module
{
    public $title = 'ساختمان';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\construction';

    public function init()
    {                
        $this->modules = [
            'location' => 'nad\engineering\construction\location\Module',
            'stage' => 'nad\engineering\construction\stage\Module',        
            'investigation' => 'nad\engineering\construction\investigation\Module'
        ];
        parent::init();
    }
}
