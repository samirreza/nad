<?php

namespace nad\seaport;

use Yii;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;

    public function init()
    {
        Yii::configure($this, require(__DIR__ . '/config.php'));
        $this->modules = [
            'wayside' => 'nad\seaport\wayside\Module',
        ];
        parent::init();
    }
}
