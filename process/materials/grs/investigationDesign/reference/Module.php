<?php

namespace nad\process\materials\grs\investigationDesign\reference;

use nad\process\materials\grs\investigationDesign\Module as BaseModule;

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
                        'url' => ['/grs/investigationDesign/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/grs/investigationDesign/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/grs/investigationDesign/report/manage/index']
                    ],
                    // [
                    //     'label' => 'روش',
                    //     'url' => ['/grs/investigationDesign/method/manage/index']
                    // ],
                    // [
                    //     'label' => 'دستورالعمل',
                    //     'url' => ['/grs/investigationDesign/instruction/manage/index']
                    // ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/grs/investigationDesign/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/grs/investigationDesign/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/grs/investigationDesign/report/manage/archived-index']
                    ],
                    // [
                    //     'label' => 'روش',
                    //     'url' => ['/grs/investigationDesign/method/manage/archived-index']
                    // ],
                    // [
                    //     'label' => 'دستورالعمل',
                    //     'url' => ['/grs/investigationDesign/instruction/manage/archived-index']
                    // ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/grs/investigationDesign/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/grs/investigationDesign/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/grs/investigationDesign/report/manage/index-history']
                    ],
                    // [
                    //     'label' => 'روش',
                    //     'url' => ['/grs/investigationDesign/method/manage/index-history']
                    // ],
                    // [
                    //     'label' => 'دستورالعمل',
                    //     'url' => ['/grs/investigationDesign/instruction/manage/index-history']
                    // ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/grs/investigationDesign/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/grs/investigationDesign/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
