<?php
namespace nad\engineering;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;

    public function init()
    {
        parent::init();
        $this->modules = [
            'resource' => [
                'class' => 'nad\engineering\resource\Module',
            ],
        ];
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
