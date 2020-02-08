<?php

namespace nad\engineering\geotechnics;

class Module extends \yii\base\Module
{
    public $title = 'ژئوتکنیک';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\geotechnics';

    /**
     * TODO the name of module "location" should be changed to "group" (group of documents) but does not matter for now...
     */
    public function init()
    {
        $this->modules = [
            'stage' => 'nad\engineering\geotechnics\stage\Module',
            'device' => 'nad\engineering\geotechnics\device\Module',
            'location' => 'nad\engineering\geotechnics\location\Module',
            'document' => 'nad\engineering\geotechnics\document\Module',
            'site' => 'nad\engineering\geotechnics\site\Module',
        ];
        parent::init();
    }
}
