<?php
namespace nad\factory\production\unit3;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'کارخانه - تولید - تولید';
    public $department = 'کارخانه';
    public $pluralLabel = 'تولید';
    public $singularLabel = 'تولید';

    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\factory\production\unit3';

    public function init()
    {
        $this->modules = [
            'investigation1' => 'nad\factory\production\unit3\investigation1\Module',
            'investigation2' => 'nad\factory\production\unit3\investigation2\Module',
            'investigation3' => 'nad\factory\production\unit3\investigation3\Module',
            'investigation4' => 'nad\factory\production\unit3\investigation4\Module',
            'investigation5' => 'nad\factory\production\unit3\investigation5\Module',
        ];

        // $this->horizontalMenuItems = [
        //     []
        // ];

        parent::init();
    }
}
