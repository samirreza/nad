<?php

namespace nad\equipment;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;

    public function init()
    {
        $this->modules = [
            'material' => 'nad\equipment\material\Module',
            'model' => 'nad\equipment\model\Module',
            'sample' => 'nad\equipment\sample\Module',
            'tool' => 'nad\equipment\tool\Module'
        ];
        parent::init();
    }
}
