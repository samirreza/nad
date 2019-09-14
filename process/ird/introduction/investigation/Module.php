<?php

namespace nad\process\ird\introduction\investigation;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\ird\introduction\investigation\source\Module',
            'proposal' => 'nad\process\ird\introduction\investigation\proposal\Module',
            'report' => 'nad\process\ird\introduction\investigation\report\Module',
            'reference' => 'nad\process\ird\introduction\investigation\reference\Module',
            'method' => 'nad\process\ird\introduction\investigation\method\Module'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'لیست‌ منشا',
                        'url' => ['/introduction/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['/introduction/investigation/source/manage/create']
                    ]
                ]
            ],
            [
                'label' => 'لیست پروپوزال',
                'url' => ['/introduction/investigation/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش',
                        'url' => ['/introduction/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/introduction/investigation/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/introduction/investigation/report/manage/generate-graph']
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'لیست روش‌ها',
                        'url' => ['/introduction/investigation/method/manage/index']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/introduction/investigation/method/manage/create']
                    ]
                ]
            ],
            [
                'label' => 'لیست منابع',
                'url' => ['/introduction/investigation/reference/manage/index']
            ]
        ];
        parent::init();
    }
}
