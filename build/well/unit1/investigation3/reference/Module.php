<?php

namespace nad\build\well\unit1\investigation3\reference;

use nad\build\well\unit1\investigation3\Module as BaseModule;

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
                        'url' => ['/build/well/unit1/investigation3/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/build/well/unit1/investigation3/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/build/well/unit1/investigation3/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/build/well/unit1/investigation3/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/build/well/unit1/investigation3/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/build/well/unit1/investigation3/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/build/well/unit1/investigation3/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/build/well/unit1/investigation3/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/build/well/unit1/investigation3/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/build/well/unit1/investigation3/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/build/well/unit1/investigation3/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/build/well/unit1/investigation3/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/build/well/unit1/investigation3/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/build/well/unit1/investigation3/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/build/well/unit1/investigation3/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/build/well/unit1/investigation3/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/build/well/unit1/investigation3/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
