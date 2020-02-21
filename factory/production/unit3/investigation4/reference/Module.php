<?php

namespace nad\factory\production\unit3\investigation4\reference;

use nad\factory\production\unit3\investigation4\Module as BaseModule;

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
                        'url' => ['/factory/production/unit3/investigation4/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/factory/production/unit3/investigation4/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/factory/production/unit3/investigation4/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/factory/production/unit3/investigation4/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/factory/production/unit3/investigation4/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/factory/production/unit3/investigation4/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/factory/production/unit3/investigation4/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/factory/production/unit3/investigation4/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/factory/production/unit3/investigation4/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/factory/production/unit3/investigation4/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/factory/production/unit3/investigation4/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/factory/production/unit3/investigation4/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/factory/production/unit3/investigation4/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/factory/production/unit3/investigation4/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/factory/production/unit3/investigation4/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/factory/production/unit3/investigation4/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/factory/production/unit3/investigation4/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}