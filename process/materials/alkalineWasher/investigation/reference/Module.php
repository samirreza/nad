<?php

namespace nad\process\materials\alkalineWasher\investigation\reference;

use nad\process\materials\alkalineWasher\investigation\Module as BaseModule;

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
                        'url' => ['/process/materials/alkalineWasher/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/process/materials/alkalineWasher/investigation/proposal/manage/index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/process/materials/alkalineWasher/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/process/materials/alkalineWasher/investigation/method/manage/index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/process/materials/alkalineWasher/investigation/instruction/manage/index']
                    ],
                ]
            ],
            [
                'label' => 'داده گاه ها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/process/materials/alkalineWasher/investigation/source/manage/archived-index']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/process/materials/alkalineWasher/investigation/proposal/manage/archived-index']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/process/materials/alkalineWasher/investigation/report/manage/archived-index']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/process/materials/alkalineWasher/investigation/method/manage/archived-index']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/process/materials/alkalineWasher/investigation/instruction/manage/archived-index']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه های روندها',
                'items' => [
                    [
                        'label' => 'منشا',
                        'url' => ['/process/materials/alkalineWasher/investigation/source/manage/index-history']
                    ],
                    [
                        'label' => 'پروپوزال',
                        'url' => ['/process/materials/alkalineWasher/investigation/proposal/manage/index-history']
                    ],
                    [
                        'label' => 'گزارش',
                        'url' => ['/process/materials/alkalineWasher/investigation/report/manage/index-history']
                    ],
                    [
                        'label' => 'روش',
                        'url' => ['/process/materials/alkalineWasher/investigation/method/manage/index-history']
                    ],
                    [
                        'label' => 'دستورالعمل',
                        'url' => ['/process/materials/alkalineWasher/investigation/instruction/manage/index-history']
                    ]
                ]
            ],
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/process/materials/alkalineWasher/investigation/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/process/materials/alkalineWasher/investigation/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
