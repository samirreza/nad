<?php

namespace nad\engineering\control;

class Module extends \yii\base\Module
{
    public $title = 'کنترل';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\control';

    /**
     * TODO the name of module "location" should be changed to "group" (group of documents) but does not matter for now...
     */
    public function init()
    {
        $this->modules = [
            'stage' => 'nad\engineering\control\stage\Module',
            'device' => 'nad\engineering\control\device\Module',
            'location' => 'nad\engineering\control\location\Module',
            'document' => 'nad\engineering\control\document\Module',
            // 'site' => 'nad\engineering\control\site\Module',
        ];
        parent::init();
    }
}
