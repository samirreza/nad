<?php
namespace nad\seaport\wayside\unit1;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'بندر - واحد بندر - واحد 1';
    public $department = 'بندر';
    public $pluralLabel = 'واحد 1';
    public $singularLabel = 'واحد 1';

    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\seaport\wayside\unit1';

    public function init()
    {
        $this->modules = [
            'investigation1' => 'nad\seaport\wayside\unit1\investigation1\Module',
            'investigation2' => 'nad\seaport\wayside\unit1\investigation2\Module',
            'investigation3' => 'nad\seaport\wayside\unit1\investigation3\Module',
            'investigation4' => 'nad\seaport\wayside\unit1\investigation4\Module',
            'investigation5' => 'nad\seaport\wayside\unit1\investigation5\Module',
        ];

        // $this->horizontalMenuItems = [
        //     []
        // ];

        parent::init();
    }
}
