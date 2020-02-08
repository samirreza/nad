<?php

namespace nad\engineering\instrument\device\investigationImprovement\reference;

use nad\engineering\instrument\device\investigationImprovement\Module as BaseModule;

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
                        'url' => ['/engineering/instrument/device/investigationImprovement/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/engineering/instrument/device/investigationImprovement/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/engineering/instrument/device/investigationImprovement/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/engineering/instrument/device/investigationImprovement/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/engineering/instrument/device/investigationImprovement/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/engineering/instrument/device/investigationImprovement/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/engineering/instrument/device/investigationImprovement/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/engineering/instrument/device/investigationImprovement/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/engineering/instrument/device/investigationImprovement/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/engineering/instrument/device/investigationImprovement/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/engineering/instrument/device/investigationImprovement/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/engineering/instrument/device/investigationImprovement/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/engineering/instrument/device/investigationImprovement/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/engineering/instrument/device/investigationImprovement/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/engineering/instrument/device/investigationImprovement/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/engineering/instrument/device/investigationImprovement/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/engineering/instrument/device/investigationImprovement/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
