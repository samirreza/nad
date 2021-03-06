<?php
namespace nad\factory\production\unit2;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'کارخانه - تولید - آزمایشگاه';
    public $department = 'کارخانه';
    public $pluralLabel = 'آزمایشگاه';
    public $singularLabel = 'آزمایشگاه';

    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\factory\production\unit2';

    public function init()
    {
        $this->modules = [
            'investigation1' => 'nad\factory\production\unit2\investigation1\Module',
            'investigation2' => 'nad\factory\production\unit2\investigation2\Module',
            'investigation3' => 'nad\factory\production\unit2\investigation3\Module',
            'investigation4' => 'nad\factory\production\unit2\investigation4\Module',
            'investigation5' => 'nad\factory\production\unit2\investigation5\Module',
        ];

        // $this->horizontalMenuItems = [
        //     []
        // ];

        parent::init();
    }
}
