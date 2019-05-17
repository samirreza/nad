<?php

namespace nad\process\ird\pool;

class Module extends \yii\base\Module
{
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\ird\pool';

    public function init()
    {
        $this->modules = [
            'investigation' => 'nad\process\ird\pool\investigation\Module'
        ];
        parent::init();
    }
}
