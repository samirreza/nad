<?php
namespace nad\seaport\wayside\unit2;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'بندر - واحد بندر - واحد 2';
    public $department = 'بندر';
    public $pluralLabel = 'واحد 2';
    public $singularLabel = 'واحد 2';

    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\seaport\wayside\unit2';

    public function init()
    {
        $this->modules = [
            'investigation1' => 'nad\seaport\wayside\unit2\investigation1\Module',
            'investigation2' => 'nad\seaport\wayside\unit2\investigation2\Module',
            'investigation3' => 'nad\seaport\wayside\unit2\investigation3\Module',
            'investigation4' => 'nad\seaport\wayside\unit2\investigation4\Module',
            'investigation5' => 'nad\seaport\wayside\unit2\investigation5\Module',
        ];

        // $this->horizontalMenuItems = [
        //     []
        // ];

        parent::init();
    }
}
