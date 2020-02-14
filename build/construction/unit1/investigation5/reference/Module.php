<?php

namespace nad\build\construction\unit1\investigation5\reference;

use nad\build\construction\unit1\investigation5\Module as BaseModule;

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
                        'url' => ['/build/construction/unit1/investigation5/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/build/construction/unit1/investigation5/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/build/construction/unit1/investigation5/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/build/construction/unit1/investigation5/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/build/construction/unit1/investigation5/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/build/construction/unit1/investigation5/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/build/construction/unit1/investigation5/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/build/construction/unit1/investigation5/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/build/construction/unit1/investigation5/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/build/construction/unit1/investigation5/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/build/construction/unit1/investigation5/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/build/construction/unit1/investigation5/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/build/construction/unit1/investigation5/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/build/construction/unit1/investigation5/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/build/construction/unit1/investigation5/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/build/construction/unit1/investigation5/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/build/construction/unit1/investigation5/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
