<?php

namespace nad\temporary\supply\unit3\investigation3\reference;

use nad\temporary\supply\unit3\investigation3\Module as BaseModule;

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
                        'url' => ['/temporary/supply/unit3/investigation3/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/temporary/supply/unit3/investigation3/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/temporary/supply/unit3/investigation3/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/temporary/supply/unit3/investigation3/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/temporary/supply/unit3/investigation3/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/temporary/supply/unit3/investigation3/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/temporary/supply/unit3/investigation3/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/temporary/supply/unit3/investigation3/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/temporary/supply/unit3/investigation3/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/temporary/supply/unit3/investigation3/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/temporary/supply/unit3/investigation3/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/temporary/supply/unit3/investigation3/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/temporary/supply/unit3/investigation3/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/temporary/supply/unit3/investigation3/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/temporary/supply/unit3/investigation3/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/temporary/supply/unit3/investigation3/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/temporary/supply/unit3/investigation3/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
