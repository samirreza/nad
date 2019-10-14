<?php

namespace nad\process\materials\acidicWasher\investigation;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\materials\acidicWasher\investigation\source\Module',
            'proposal' => 'nad\process\materials\acidicWasher\investigation\proposal\Module',
            'report' => 'nad\process\materials\acidicWasher\investigation\report\Module',
            'reference' => 'nad\process\materials\acidicWasher\investigation\reference\Module',
            'method' => 'nad\process\materials\acidicWasher\investigation\method\Module'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['/acidicWasher/investigation/source/manage/create']
                    ],
                    [
                        'label' => 'لیست‌ منشاهای برنامه',
                        'url' => ['/acidicWasher/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'لیست رده های منشا',
                        'url' => ['/acidicWasher/investigation/source/category/index']
                    ],
                ]
            ],
            [
                'label' => 'لیست پروپوزال',
                'url' => ['/acidicWasher/investigation/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش',
                        'url' => ['/acidicWasher/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/acidicWasher/investigation/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/acidicWasher/investigation/report/manage/generate-graph']
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'لیست روش‌ها',
                        'url' => ['/acidicWasher/investigation/method/manage/index']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/acidicWasher/investigation/method/manage/create']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
