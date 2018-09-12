<?php

namespace modules\nad\repairer\backend;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'modules\nad\repairer\backend\controllers';

    public function init()
    {
        parent::init();
        $this->modules = [
            'phonebook' => [
                'class' => 'modules\nad\repairer\backend\modules\phonebook\Module',
            ],
        ];
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}