<?php
namespace nad\build\well\unit3;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'احداث - چاه - واحد 3';
    public $department = 'احداث';
    public $pluralLabel = 'واحد 3';
    public $singularLabel = 'واحد 3';

    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\build\well\unit3';

    public function init()
    {
        $this->modules = [
            'investigation1' => 'nad\build\well\unit3\investigation1\Module',
            'investigation2' => 'nad\build\well\unit3\investigation2\Module',
            'investigation3' => 'nad\build\well\unit3\investigation3\Module',
            'investigation4' => 'nad\build\well\unit3\investigation4\Module',
            'investigation5' => 'nad\build\well\unit3\investigation5\Module',
        ];

        // $this->horizontalMenuItems = [
        //     []
        // ];

        parent::init();
    }
}
