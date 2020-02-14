<?php
namespace nad\temporary\supply\unit2;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'موقت - تامین - واحد 2';
    public $department = 'موقت';
    public $pluralLabel = 'واحد 2';
    public $singularLabel = 'واحد 2';

    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\temporary\supply\unit2';

    public function init()
    {
        $this->modules = [
            'investigation1' => 'nad\temporary\supply\unit2\investigation1\Module',
            'investigation2' => 'nad\temporary\supply\unit2\investigation2\Module',
            'investigation3' => 'nad\temporary\supply\unit2\investigation3\Module',
            'investigation4' => 'nad\temporary\supply\unit2\investigation4\Module',
            'investigation5' => 'nad\temporary\supply\unit2\investigation5\Module',
        ];

        // $this->horizontalMenuItems = [
        //     []
        // ];

        parent::init();
    }
}
