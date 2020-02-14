<?php
namespace nad\seaport\wayside\unit3;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'بندر - واحد بندر - واحد 3';
    public $department = 'بندر';
    public $pluralLabel = 'واحد 3';
    public $singularLabel = 'واحد 3';

    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\seaport\wayside\unit3';

    public function init()
    {
        $this->modules = [
            'investigation1' => 'nad\seaport\wayside\unit3\investigation1\Module',
            'investigation2' => 'nad\seaport\wayside\unit3\investigation2\Module',
            'investigation3' => 'nad\seaport\wayside\unit3\investigation3\Module',
            'investigation4' => 'nad\seaport\wayside\unit3\investigation4\Module',
            'investigation5' => 'nad\seaport\wayside\unit3\investigation5\Module',
        ];

        // $this->horizontalMenuItems = [
        //     []
        // ];

        parent::init();
    }
}
