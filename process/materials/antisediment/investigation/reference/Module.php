<?php

namespace nad\process\materials\antisediment\investigation\reference;

use nad\process\materials\antisediment\investigation\Module as BaseModule;

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
                        'url' => ['/antisediment/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/antisediment/investigation/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/antisediment/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/antisediment/investigation/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/antisediment/investigation/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/antisediment/investigation/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/antisediment/investigation/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/antisediment/investigation/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/antisediment/investigation/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/antisediment/investigation/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/antisediment/investigation/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/antisediment/investigation/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/antisediment/investigation/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/antisediment/investigation/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/antisediment/investigation/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/antisediment/investigation/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/antisediment/investigation/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
