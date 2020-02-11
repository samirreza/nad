<?php

namespace nad\engineering\mechanics;

class Module extends \yii\base\Module
{
    public $title = 'مکانیک';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\mechanics';

    /**
     * TODO the name of module "location" should be changed to "group" (group of documents) but does not matter for now...
     */
    public function init()
    {
        $this->modules = [
            // 'stage' => 'nad\engineering\mechanics\stage\Module',
            'device' => 'nad\engineering\mechanics\device\Module',
            // 'location' => 'nad\engineering\mechanics\location\Module',
            // 'document' => 'nad\engineering\mechanics\document\Module',
            // 'site' => 'nad\engineering\mechanics\site\Module',
        ];
        parent::init();
    }
}
