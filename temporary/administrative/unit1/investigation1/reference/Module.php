<?php

namespace nad\temporary\administrative\unit1\investigation1\reference;

use nad\temporary\administrative\unit1\investigation1\Module as BaseModule;

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
                        'url' => ['/temporary/administrative/unit1/investigation1/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/temporary/administrative/unit1/investigation1/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/temporary/administrative/unit1/investigation1/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/temporary/administrative/unit1/investigation1/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/temporary/administrative/unit1/investigation1/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/temporary/administrative/unit1/investigation1/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/temporary/administrative/unit1/investigation1/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/temporary/administrative/unit1/investigation1/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/temporary/administrative/unit1/investigation1/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/temporary/administrative/unit1/investigation1/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/temporary/administrative/unit1/investigation1/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/temporary/administrative/unit1/investigation1/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/temporary/administrative/unit1/investigation1/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/temporary/administrative/unit1/investigation1/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/temporary/administrative/unit1/investigation1/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/temporary/administrative/unit1/investigation1/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/temporary/administrative/unit1/investigation1/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
