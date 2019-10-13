<?php

namespace nad\process\ird\filter;

class Module extends \yii\base\Module
{
    public $title = 'فیلتر';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\ird\filter';

    public function init()
    {
        $this->modules = [
            'investigation' => 'nad\process\ird\filter\investigation\Module'
        ];
        parent::init();
    }
}
