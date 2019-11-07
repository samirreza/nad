<?php

namespace nad\process\ird\sedimentation\investigationMonitor\reference;

use nad\process\ird\sedimentation\investigationMonitor\Module as BaseModule;

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
                        'url' => ['/sedimentation/investigationMonitor/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/sedimentation/investigationMonitor/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/sedimentation/investigationMonitor/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/sedimentation/investigationMonitor/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/sedimentation/investigationMonitor/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/sedimentation/investigationMonitor/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/sedimentation/investigationMonitor/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/sedimentation/investigationMonitor/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/sedimentation/investigationMonitor/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/sedimentation/investigationMonitor/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/sedimentation/investigationMonitor/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/sedimentation/investigationMonitor/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/sedimentation/investigationMonitor/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/sedimentation/investigationMonitor/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/sedimentation/investigationMonitor/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/sedimentation/investigationMonitor/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/sedimentation/investigationMonitor/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
