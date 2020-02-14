<?php

namespace nad\temporary;

use Yii;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;

    public function init()
    {
        Yii::configure($this, require(__DIR__ . '/config.php'));
        $this->modules = [
            'supply' => 'nad\temporary\supply\Module',
            'informationtech' => 'nad\temporary\informationtech\Module',
            'financial' => 'nad\temporary\financial\Module',
            'administrative' => 'nad\temporary\administrative\Module',
        ];
        parent::init();
    }
}
