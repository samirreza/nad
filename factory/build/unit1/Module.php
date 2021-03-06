<?php
namespace nad\factory\build\unit1;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'کارخانه - احداث - واحد 1';
    public $department = 'کارخانه';
    public $pluralLabel = 'واحد 1';
    public $singularLabel = 'واحد 1';

    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\factory\build\unit1';

    public function init()
    {
        $this->modules = [
            'investigation1' => 'nad\factory\build\unit1\investigation1\Module',
            'investigation2' => 'nad\factory\build\unit1\investigation2\Module',
            'investigation3' => 'nad\factory\build\unit1\investigation3\Module',
            'investigation4' => 'nad\factory\build\unit1\investigation4\Module',
            'investigation5' => 'nad\factory\build\unit1\investigation5\Module',
        ];

        // $this->horizontalMenuItems = [
        //     []
        // ];

        parent::init();
    }
}
