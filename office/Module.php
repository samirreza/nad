<?php

namespace nad\office;

use Yii;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;

    public function init()
    {
        Yii::configure($this, require(__DIR__ . '/config.php'));
        $this->modules = [
            'expert' => [
                'class' => 'nad\office\modules\expert\Module'
            ]
        ];
        parent::init();
    }
}
