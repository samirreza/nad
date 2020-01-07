<?php

namespace nad\process\ird\newTechnology\investigationMonitor\reference;

use nad\process\ird\newTechnology\investigationMonitor\Module as BaseModule;

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
                        'url' => ['/newTechnology/investigationMonitor/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/newTechnology/investigationMonitor/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/newTechnology/investigationMonitor/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/newTechnology/investigationMonitor/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/newTechnology/investigationMonitor/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/newTechnology/investigationMonitor/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/newTechnology/investigationMonitor/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/newTechnology/investigationMonitor/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/newTechnology/investigationMonitor/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/newTechnology/investigationMonitor/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/newTechnology/investigationMonitor/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/newTechnology/investigationMonitor/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/newTechnology/investigationMonitor/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/newTechnology/investigationMonitor/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/newTechnology/investigationMonitor/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/newTechnology/investigationMonitor/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/newTechnology/investigationMonitor/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
