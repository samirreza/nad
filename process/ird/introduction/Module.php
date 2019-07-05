<?php

namespace nad\process\ird\introduction;

class Module extends \yii\base\Module
{
    public $title = 'آشنایی';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\ird\introduction';

    public function init()
    {
        $this->modules = [
            'investigation' => 'nad\process\ird\introduction\investigation\Module'
        ];
        parent::init();
    }
}
