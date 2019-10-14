<?php

namespace nad\process\materials\alkalineWasher;

class Module extends \yii\base\Module
{
    public $title = 'شوینده قلیایی';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\materials\alkalineWasher';

    public function init()
    {
        $this->modules = [
            'investigation' => 'nad\process\materials\alkalineWasher\investigation\Module'
        ];
        parent::init();
    }
}
