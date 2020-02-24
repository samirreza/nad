<?php
namespace nad\factory\production\unit4;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'کارخانه - تولید - تعمیرات و نگهداری';
    public $department = 'کارخانه';
    public $pluralLabel = 'تعمیرات و نگهداری';
    public $singularLabel = 'تعمیرات و نگهداری';

    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\factory\production\unit4';

    public function init()
    {
        $this->modules = [
            'investigation1' => 'nad\factory\production\unit4\investigation1\Module',
            'investigation2' => 'nad\factory\production\unit4\investigation2\Module',
            'investigation3' => 'nad\factory\production\unit4\investigation3\Module',
            'investigation4' => 'nad\factory\production\unit4\investigation4\Module',
            'investigation5' => 'nad\factory\production\unit4\investigation5\Module',
        ];

        // $this->horizontalMenuItems = [
        //     []
        // ];

        parent::init();
    }
}
