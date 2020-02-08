<?php

namespace nad\engineering\electricity\device\investigationMonitorMethods\reference;

use nad\engineering\electricity\device\investigationMonitorMethods\Module as BaseModule;

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
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/engineering/electricity/device/investigationMonitorMethods/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
