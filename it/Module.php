<?php
namespace nad\it;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;

    public function init()
    {
        parent::init();
        $this->modules = [
            'equipment' => [
                'class' => 'nad\it\equipment\Module',
            ],
        ];
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
