<?php

namespace nad\seaport\wayside\unit3\investigation2\reference;

use nad\seaport\wayside\unit3\investigation2\Module as BaseModule;

class Module extends BaseModule
{
    public $defaultRoute = 'manage/index';

    public function init()
    {
        parent::init();


        $this->horizontalMenuItems = [
            [
                'label' => 'برنامه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/seaport/wayside/unit3/investigation2/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/seaport/wayside/unit3/investigation2/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/seaport/wayside/unit3/investigation2/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/seaport/wayside/unit3/investigation2/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/seaport/wayside/unit3/investigation2/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/seaport/wayside/unit3/investigation2/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/seaport/wayside/unit3/investigation2/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/seaport/wayside/unit3/investigation2/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/seaport/wayside/unit3/investigation2/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/seaport/wayside/unit3/investigation2/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/seaport/wayside/unit3/investigation2/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/seaport/wayside/unit3/investigation2/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/seaport/wayside/unit3/investigation2/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/seaport/wayside/unit3/investigation2/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/seaport/wayside/unit3/investigation2/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/seaport/wayside/unit3/investigation2/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/seaport/wayside/unit3/investigation2/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
