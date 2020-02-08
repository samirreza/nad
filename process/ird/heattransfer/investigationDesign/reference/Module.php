<?php

namespace nad\process\ird\heattransfer\investigationDesign\reference;

use nad\process\ird\heattransfer\investigationDesign\Module as BaseModule;

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
                        'url' => ['/heattransfer/investigationDesign/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/heattransfer/investigationDesign/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/heattransfer/investigationDesign/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/heattransfer/investigationDesign/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/heattransfer/investigationDesign/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/heattransfer/investigationDesign/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/heattransfer/investigationDesign/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/heattransfer/investigationDesign/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/heattransfer/investigationDesign/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/heattransfer/investigationDesign/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/heattransfer/investigationDesign/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/heattransfer/investigationDesign/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/heattransfer/investigationDesign/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/heattransfer/investigationDesign/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/heattransfer/investigationDesign/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/heattransfer/investigationDesign/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/heattransfer/investigationDesign/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
