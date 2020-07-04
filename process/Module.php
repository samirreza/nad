<?php

namespace nad\process;

class Module extends \yii\base\Module
{
    public $title = 'مواد';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process';

    public function init()
    {
        $this->modules = [
            'ird' => 'nad\process\ird\Module',            
            'materials' => 'nad\process\materials\Module',            
            'laboratory' => 'nad\process\laboratory\Module',
        ];
        parent::init();
    }
}
