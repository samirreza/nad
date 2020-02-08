<?php

namespace nad\engineering\electricity;

class Module extends \yii\base\Module
{
    public $title = 'برق';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\electricity';

    /**
     * TODO the name of module "location" should be changed to "group" (group of documents) but does not matter for now...
     */
    public function init()
    {
        $this->modules = [
            'stage' => 'nad\engineering\electricity\stage\Module',
            'device' => 'nad\engineering\electricity\device\Module',
            'location' => 'nad\engineering\electricity\location\Module',
            'document' => 'nad\engineering\electricity\document\Module',
            'site' => 'nad\engineering\electricity\site\Module',
        ];
        parent::init();
    }
}
