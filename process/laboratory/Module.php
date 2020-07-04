<?php

namespace nad\process\laboratory;

class Module extends \yii\base\Module
{
    public $title = 'آزمایشگاه';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\laboratory';

    public function init()
    {
        $this->modules = [
            'unit1' => 'nad\process\laboratory\unit1\Module',
            'unit2' => 'nad\process\laboratory\unit2\Module',
            'unit3' => 'nad\process\laboratory\unit3\Module',
        ];
        parent::init();
    }
}
