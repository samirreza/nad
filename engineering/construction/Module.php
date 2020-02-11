<?php

namespace nad\engineering\construction;

class Module extends \yii\base\Module
{
    public $title = 'ساختمان';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\construction';

    /**
     * TODO the name of module "location" should be changed to "group" (group of documents) but does not matter for now...
     */
    public function init()
    {
        $this->modules = [
            'stage' => 'nad\engineering\construction\stage\Module',
            // 'device' => 'nad\engineering\construction\device\Module',
            'location' => 'nad\engineering\construction\location\Module',
            'document' => 'nad\engineering\construction\document\Module',
            // 'site' => 'nad\engineering\construction\site\Module',
        ];
        parent::init();
    }
}
