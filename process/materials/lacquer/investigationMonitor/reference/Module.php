<?php

namespace nad\process\materials\lacquer\investigationMonitor\reference;

use nad\process\materials\lacquer\investigationMonitor\Module as BaseModule;

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
                        'url' => ['/lacquer/investigationMonitor/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/lacquer/investigationMonitor/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/lacquer/investigationMonitor/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/lacquer/investigationMonitor/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/lacquer/investigationMonitor/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/lacquer/investigationMonitor/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/lacquer/investigationMonitor/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/lacquer/investigationMonitor/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/lacquer/investigationMonitor/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/lacquer/investigationMonitor/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/lacquer/investigationMonitor/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/lacquer/investigationMonitor/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/lacquer/investigationMonitor/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/lacquer/investigationMonitor/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/lacquer/investigationMonitor/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/lacquer/investigationMonitor/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/lacquer/investigationMonitor/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
