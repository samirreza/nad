<?php

namespace nad\process\materials\alkalineWasher\investigation;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\materials\alkalineWasher\investigation\source\Module',
            'proposal' => 'nad\process\materials\alkalineWasher\investigation\proposal\Module',
            'report' => 'nad\process\materials\alkalineWasher\investigation\report\Module',
            'reference' => 'nad\process\materials\alkalineWasher\investigation\reference\Module',
            'method' => 'nad\process\materials\alkalineWasher\investigation\method\Module'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['/alkalineWasher/investigation/source/manage/create']
                    ],
                    [
                        'label' => 'لیست‌ منشاهای برنامه',
                        'url' => ['/alkalineWasher/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'لیست رده های منشا',
                        'url' => ['/alkalineWasher/investigation/source/category/index']
                    ],
                ]
            ],
            [
                'label' => 'لیست پروپوزال',
                'url' => ['/alkalineWasher/investigation/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش',
                        'url' => ['/alkalineWasher/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/alkalineWasher/investigation/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/alkalineWasher/investigation/report/manage/generate-graph']
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'لیست روش‌ها',
                        'url' => ['/alkalineWasher/investigation/method/manage/index']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/alkalineWasher/investigation/method/manage/create']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
