<?php

namespace nad\build;

use Yii;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;

    public function init()
    {
        Yii::configure($this, require(__DIR__ . '/config.php'));
        $this->modules = [
            'construction' => 'nad\build\construction\Module',
            'equipment' => 'nad\build\equipment\Module',
            'well' => 'nad\build\well\Module',
        ];
        parent::init();
    }
}
