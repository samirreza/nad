<?php

namespace nad\process\materials\antimicrobial\investigation\reference;

use nad\process\materials\antimicrobial\investigation\Module as BaseModule;

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
                        'url' => ['/antimicrobial/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/antimicrobial/investigation/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/antimicrobial/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/antimicrobial/investigation/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/antimicrobial/investigation/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/antimicrobial/investigation/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/antimicrobial/investigation/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/antimicrobial/investigation/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/antimicrobial/investigation/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/antimicrobial/investigation/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/antimicrobial/investigation/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/antimicrobial/investigation/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/antimicrobial/investigation/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/antimicrobial/investigation/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/antimicrobial/investigation/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/antimicrobial/investigation/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/antimicrobial/investigation/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
