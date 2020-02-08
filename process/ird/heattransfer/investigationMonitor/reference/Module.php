<?php

namespace nad\process\ird\heattransfer\investigationMonitor\reference;

use nad\process\ird\heattransfer\investigationMonitor\Module as BaseModule;

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
                        'url' => ['/heattransfer/investigationMonitor/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/heattransfer/investigationMonitor/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/heattransfer/investigationMonitor/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/heattransfer/investigationMonitor/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/heattransfer/investigationMonitor/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/heattransfer/investigationMonitor/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/heattransfer/investigationMonitor/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/heattransfer/investigationMonitor/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/heattransfer/investigationMonitor/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/heattransfer/investigationMonitor/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/heattransfer/investigationMonitor/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/heattransfer/investigationMonitor/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/heattransfer/investigationMonitor/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/heattransfer/investigationMonitor/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/heattransfer/investigationMonitor/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/heattransfer/investigationMonitor/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/heattransfer/investigationMonitor/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
