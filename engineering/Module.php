<?php

namespace nad\engineering;

use Yii;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;

    public function init()
    {
        Yii::configure($this, require(__DIR__ . '/config.php'));
        $this->modules = [
            'plant' => 'nad\engineering\plant\Module',
            'resource' => 'nad\engineering\resource\Module',
            'location' => 'nad\engineering\location\Module',
            'document' => 'nad\engineering\document\Module',
            'equipment' => 'nad\engineering\equipment\Module'
        ];
        parent::init();
    }
}
