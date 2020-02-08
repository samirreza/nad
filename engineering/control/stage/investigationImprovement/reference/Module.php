<?php

namespace nad\engineering\control\stage\investigationImprovement\reference;

use nad\engineering\control\stage\investigationImprovement\Module as BaseModule;

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
                        'url' => ['/engineering/control/stage/investigationImprovement/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/engineering/control/stage/investigationImprovement/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/engineering/control/stage/investigationImprovement/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/engineering/control/stage/investigationImprovement/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/engineering/control/stage/investigationImprovement/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/engineering/control/stage/investigationImprovement/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/engineering/control/stage/investigationImprovement/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/engineering/control/stage/investigationImprovement/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/engineering/control/stage/investigationImprovement/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/engineering/control/stage/investigationImprovement/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/engineering/control/stage/investigationImprovement/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/engineering/control/stage/investigationImprovement/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/engineering/control/stage/investigationImprovement/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/engineering/control/stage/investigationImprovement/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/engineering/control/stage/investigationImprovement/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/engineering/control/stage/investigationImprovement/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/engineering/control/stage/investigationImprovement/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
