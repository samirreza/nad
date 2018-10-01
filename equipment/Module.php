<?php

namespace modules\nad\equipment;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;

    public function init()
    {
        parent::init();
        $this->modules = [
            'type' => [
                'class' => 'modules\nad\equipment\modules\type\Module'
            ],
            'document' => [
                'class' => 'modules\nad\equipment\modules\document\Module'
            ]
        ];
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
