<?php
namespace nad\build\well\unit2;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'احداث - ساختمان - واحد 2';
    public $department = 'احداث';
    public $pluralLabel = 'واحد 2';
    public $singularLabel = 'واحد 2';

    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\build\well\unit2';

    public function init()
    {
        $this->modules = [
            'investigation1' => 'nad\build\well\unit2\investigation1\Module',
            'investigation2' => 'nad\build\well\unit2\investigation2\Module',
            'investigation3' => 'nad\build\well\unit2\investigation3\Module',
            'investigation4' => 'nad\build\well\unit2\investigation4\Module',
            'investigation5' => 'nad\build\well\unit2\investigation5\Module',
        ];

        // $this->horizontalMenuItems = [
        //     []
        // ];

        parent::init();
    }
}
