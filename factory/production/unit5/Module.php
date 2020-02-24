<?php
namespace nad\factory\production\unit5;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'کارخانه - تولید - انبار';
    public $department = 'کارخانه';
    public $pluralLabel = 'انبار';
    public $singularLabel = 'انبار';

    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\factory\production\unit5';

    public function init()
    {
        $this->modules = [
            'investigation1' => 'nad\factory\production\unit5\investigation1\Module',
            'investigation2' => 'nad\factory\production\unit5\investigation2\Module',
            'investigation3' => 'nad\factory\production\unit5\investigation3\Module',
            'investigation4' => 'nad\factory\production\unit5\investigation4\Module',
            'investigation5' => 'nad\factory\production\unit5\investigation5\Module',
        ];

        // $this->horizontalMenuItems = [
        //     []
        // ];

        parent::init();
    }
}
