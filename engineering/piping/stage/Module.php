<?php
namespace nad\engineering\piping\stage;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $department = 'فنی';
    public $pluralLabel = 'مراحل';    
    public $singularLabel = 'مرحله';

    public $categoryListBtnLabel = 'لیست رده بندی مراحل و بسته مدارک';
    public $categoryCreateBtnLabel = 'افزودن رده مراحل و بسته مدارک';

    public $defaultRoute = 'manage/start';

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
                        'url' => ['/engineering/piping/stage/category/index#class_ajaxcreate']
                    ]
                ]
            ],
            // [
            //     'label' => 'بسته مدارک',
            //     'items' => [
            //         [
            //             'label' => 'لیست تمام گروه ها',
            //             'url' => ['/engineering/piping/location/manage/index']
            //         ],
            //         [
            //             'label' => 'افزودن گروه مدارگ',
            //             'url' => ['/engineering/piping/location/manage/index#class_ajaxcreate']
            //         ]
            //     ]
            // ],
        ];

        parent::init();
    }
}
