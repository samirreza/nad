<?php
namespace nad\process\laboratory\unit1;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'فرایند - آزمایشگاه - آزمایش های بهره برداری';
    public $department = 'فرایند';
    public $pluralLabel = 'آزمایش های بهره برداری';
    public $singularLabel = 'آزمایش های بهره برداری';

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
