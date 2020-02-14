<?php

namespace nad\factory;

use Yii;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;

    public function init()
    {
        Yii::configure($this, require(__DIR__ . '/config.php'));
        $this->modules = [
            'production' => 'nad\factory\production\Module',
            'build' => 'nad\factory\build\Module',
            'support' => 'nad\factory\support\Module',
        ];
        parent::init();
    }
}
