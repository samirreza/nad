<?php
namespace nad\temporary\administrative\unit1;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'موقت - اداری - واحد 1';
    public $department = 'موقت';
    public $pluralLabel = 'واحد 1';
    public $singularLabel = 'واحد 1';

    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\temporary\administrative\unit1';

    public function init()
    {
        $this->modules = [
            'investigation1' => 'nad\temporary\administrative\unit1\investigation1\Module',
            'investigation2' => 'nad\temporary\administrative\unit1\investigation2\Module',
            'investigation3' => 'nad\temporary\administrative\unit1\investigation3\Module',
            'investigation4' => 'nad\temporary\administrative\unit1\investigation4\Module',
            'investigation5' => 'nad\temporary\administrative\unit1\investigation5\Module',
        ];

        // $this->horizontalMenuItems = [
        //     []
        // ];

        parent::init();
    }
}
