<?php

namespace modules\nad\supplier;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'modules\nad\supplier\controllers';

    public function init()
    {
        parent::init();
        $this->modules = [
            'phonebook' => [
                'class' => 'modules\nad\supplier\modules\phonebook\Module',
            ],
        ];
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}