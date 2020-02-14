<?php
namespace nad\temporary\supply\unit3;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'موقت - تامین - واحد 3';
    public $department = 'موقت';
    public $pluralLabel = 'واحد 3';
    public $singularLabel = 'واحد 3';

    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\temporary\supply\unit3';

    public function init()
    {
        $this->modules = [
            'investigation1' => 'nad\temporary\supply\unit3\investigation1\Module',
            'investigation2' => 'nad\temporary\supply\unit3\investigation2\Module',
            'investigation3' => 'nad\temporary\supply\unit3\investigation3\Module',
            'investigation4' => 'nad\temporary\supply\unit3\investigation4\Module',
            'investigation5' => 'nad\temporary\supply\unit3\investigation5\Module',
        ];

        // $this->horizontalMenuItems = [
        //     []
        // ];

        parent::init();
    }
}
