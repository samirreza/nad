<?php
namespace nad\engineering\mechanics\document;

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
                'label' => 'مراحل',
                'items' => [
                    [
                        'label' => 'لیست مراحل',
                        'url' => ['/engineering/mechanics/stage/category/index']
                    ],
                    [
                        'label' => 'افزودن مرحله',
                        'url' => ['/engineering/mechanics/stage/category/index#class_ajaxcreate']
                    ]
                ]
            ],
            // [
            //     'label' => 'بسته مدارک',
            //     'items' => [
            //         [
            //             'label' => 'لیست تمام گروه ها',
            //             'url' => ['/engineering/mechanics/document/manage/index']
            //         ],
            //         [
            //             'label' => 'افزودن گروه مدارگ',
            //             'url' => ['/engineering/mechanics/document/manage/index#class_ajaxcreate']
            //         ]
            //     ]
            // ],
        ];

        parent::init();
    }
}
