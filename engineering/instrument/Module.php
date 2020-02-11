<?php

namespace nad\engineering\instrument;

class Module extends \yii\base\Module
{
    public $title = 'ابزار دقیق';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\instrument';

    /**
     * TODO the name of module "location" should be changed to "group" (group of documents) but does not matter for now...
     */
    public function init()
    {
        $this->modules = [
            'stage' => 'nad\engineering\instrument\stage\Module',
            'device' => 'nad\engineering\instrument\device\Module',
            'location' => 'nad\engineering\instrument\location\Module',
            'document' => 'nad\engineering\instrument\document\Module',
            // 'site' => 'nad\engineering\instrument\site\Module',
        ];
        parent::init();
    }
}
