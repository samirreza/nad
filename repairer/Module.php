<?php

namespace modules\nad\repairer;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'modules\nad\repairer\controllers';

    public function init()
    {
        parent::init();
        $this->modules = [
            'phonebook' => [
                'class' => 'modules\nad\repairer\modules\phonebook\Module',
            ],
        ];
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}