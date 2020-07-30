<?php
namespace nad\process\laboratory\unit3;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'فرایند - آزمایشگاه - تجهیزات آزمایشگاهی';
    public $department = 'فرایند';
    public $pluralLabel = 'تجهیزات آزمایشگاهی';
    public $singularLabel = 'تجهیزات آزمایشگاهی';

    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\laboratory\unit3';

    public function init()
    {
        $this->modules = [
            'investigation1' => 'nad\process\laboratory\unit3\investigation1\Module',
            'investigation2' => 'nad\process\laboratory\unit3\investigation2\Module',
            'investigation3' => 'nad\process\laboratory\unit3\investigation3\Module',
            'investigation4' => 'nad\process\laboratory\unit3\investigation4\Module',
            'investigation5' => 'nad\process\laboratory\unit3\investigation5\Module',
        ];

        // $this->horizontalMenuItems = [
        //     []
        // ];

        parent::init();
    }
}
