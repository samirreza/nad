<?php

namespace nad\process\materials\alkalineWasher\investigationDesign\reference;

use nad\process\materials\alkalineWasher\investigationDesign\Module as BaseModule;

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
                        'url' => ['/alkalineWasher/investigationDesign/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/alkalineWasher/investigationDesign/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/alkalineWasher/investigationDesign/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/alkalineWasher/investigationDesign/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/alkalineWasher/investigationDesign/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/alkalineWasher/investigationDesign/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/alkalineWasher/investigationDesign/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/alkalineWasher/investigationDesign/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/alkalineWasher/investigationDesign/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/alkalineWasher/investigationDesign/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/alkalineWasher/investigationDesign/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/alkalineWasher/investigationDesign/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/alkalineWasher/investigationDesign/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/alkalineWasher/investigationDesign/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/alkalineWasher/investigationDesign/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/alkalineWasher/investigationDesign/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/alkalineWasher/investigationDesign/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
