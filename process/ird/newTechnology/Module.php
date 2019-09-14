<?php

namespace nad\process\ird\newTechnology;

class Module extends \yii\base\Module
{
    public $title = 'تکنولوژی های نو';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\ird\newTechnology';

    public function init()
    {
        $this->modules = [
            'investigation' => 'nad\process\ird\newTechnology\investigation\Module'
        ];
        parent::init();
    }
}
