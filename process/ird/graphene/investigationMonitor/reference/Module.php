<?php

namespace nad\process\ird\graphene\investigationMonitor\reference;

use nad\process\ird\graphene\investigationMonitor\Module as BaseModule;

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
                        'url' => ['/graphene/investigationMonitor/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/graphene/investigationMonitor/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/graphene/investigationMonitor/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/graphene/investigationMonitor/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/graphene/investigationMonitor/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/graphene/investigationMonitor/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/graphene/investigationMonitor/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/graphene/investigationMonitor/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/graphene/investigationMonitor/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/graphene/investigationMonitor/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/graphene/investigationMonitor/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/graphene/investigationMonitor/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/graphene/investigationMonitor/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/graphene/investigationMonitor/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/graphene/investigationMonitor/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/graphene/investigationMonitor/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/graphene/investigationMonitor/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
