<?php

namespace nad\process\ird\ro;

class Module extends \yii\base\Module
{
    public $title = 'آر او';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\ird\ro';

    public function init()
    {
        $this->modules = [
            'investigation' => 'nad\process\ird\ro\investigation\Module'
        ];
        parent::init();
    }
}
