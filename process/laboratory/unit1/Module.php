<?php
namespace nad\process\laboratory\unit1;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'فرایند - آزمایشگاه - واحد 1';
    public $department = 'فرایند';
    public $pluralLabel = 'واحد 1';
    public $singularLabel = 'واحد 1';

    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\laboratory\unit1';

    public function init()
    {
        $this->modules = [
            'investigation1' => 'nad\process\laboratory\unit1\investigation1\Module',
        ];

        // $this->horizontalMenuItems = [
        //     []
        // ];

        parent::init();
    }
}
