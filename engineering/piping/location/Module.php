<?php
namespace nad\engineering\piping\location;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $department = 'فنی';
    public $pluralLabel = 'مدارک';
    public $singularLabel = 'مدرک';

    public $defaultRoute = 'manage/index';

    public function init()
    {                
        $this->modules = [  
            'investigation' => 'nad\engineering\piping\stage\investigation\Module', 
        ];

        $this->horizontalMenuItems = [                        
            [
                'label' => 'رده بندی مراحل و بسته مدارک',
                'items' => [
                    [
                        'label' => 'لیست رده ها',
                        'url' => ['/engineering/piping/stage/category/index']
                    ],
                    [
                        'label' => 'افزودن رده',
                        'url' => ['/engineering/piping/stage/category/index#ajaxcreate']
                    ]
                ]
            ],
            [
                'label' => 'بسته مدارک',
                'items' => [
                    [
                        'label' => 'لیست تمام گروه ها',
                        'url' => ['/engineering/piping/location/manage/index']
                    ],
                    [
                        'label' => 'افزودن گروه مدارگ',
                        'url' => ['/engineering/piping/location/manage/index#ajaxcreate']
                    ]
                ]
            ],
        ];

        parent::init();
    }
}
