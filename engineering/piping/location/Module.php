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
        $this->horizontalMenuItems = [                        
            [
                'label' => 'رده بندی مراحل',
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
