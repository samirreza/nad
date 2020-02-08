<?php

namespace nad\process\ird\hydraulic\investigation\reference;

use nad\process\ird\hydraulic\investigation\Module as BaseModule;

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
                        'url' => ['/hydraulic/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/hydraulic/investigation/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/hydraulic/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/hydraulic/investigation/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/hydraulic/investigation/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/hydraulic/investigation/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/hydraulic/investigation/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/hydraulic/investigation/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/hydraulic/investigation/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/hydraulic/investigation/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/hydraulic/investigation/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/hydraulic/investigation/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/hydraulic/investigation/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/hydraulic/investigation/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/hydraulic/investigation/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/hydraulic/investigation/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/hydraulic/investigation/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
