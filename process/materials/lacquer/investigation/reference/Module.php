<?php

namespace nad\process\materials\lacquer\investigation\reference;

use nad\process\materials\lacquer\investigation\Module as BaseModule;

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
                        'url' => ['/lacquer/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/lacquer/investigation/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/lacquer/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/lacquer/investigation/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/lacquer/investigation/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/lacquer/investigation/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/lacquer/investigation/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/lacquer/investigation/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/lacquer/investigation/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/lacquer/investigation/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/lacquer/investigation/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/lacquer/investigation/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/lacquer/investigation/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/lacquer/investigation/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/lacquer/investigation/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/lacquer/investigation/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/lacquer/investigation/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
