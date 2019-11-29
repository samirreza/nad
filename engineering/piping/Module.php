<?php

namespace nad\engineering\piping;

class Module extends \yii\base\Module
{
    public $title = 'لوله کشی';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\engineering\piping';

    /**
     * @todo the name of module "location" should be changed to "group" (group of documents) but does not matter for now...
     */
    public function init()
    {
        $this->modules = [
            'stage' => 'nad\engineering\piping\stage\Module',
            'device' => 'nad\engineering\piping\device\Module',
            'location' => 'nad\engineering\piping\location\Module',
            'document' => 'nad\engineering\piping\document\Module',
            'site' => 'nad\engineering\piping\site\Module',
        ];
        parent::init();
    }
}
