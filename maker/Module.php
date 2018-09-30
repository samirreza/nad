<?php

namespace modules\nad\maker;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'modules\nad\maker\controllers';

    public function init()
    {
        parent::init();
        $this->modules = [
            'phonebook' => [
                'class' => 'modules\nad\maker\modules\phonebook\Module',
            ],
        ];
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}