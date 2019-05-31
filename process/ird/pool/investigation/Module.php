<?php

namespace nad\process\ird\pool\investigation;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\ird\pool\investigation\source\Module',
            'proposal' => 'nad\process\ird\pool\investigation\proposal\Module',
            'report' => 'nad\process\ird\pool\investigation\report\Module',
            'reference' => 'nad\process\ird\pool\investigation\reference\Module'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'لیست‌ منشا',
                        'url' => ['/pool/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['/pool/investigation/source/manage/create']
                    ]
                ]
            ],
            [
                'label' => 'لیست پروپوزال',
                'url' => ['/pool/investigation/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش',
                        'url' => ['/pool/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/pool/investigation/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/pool/investigation/report/manage/generate-graph']
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'لیست روش‌ها',
                        'url' => ['/']
                    ],
                    [
                        'label' => 'رده‌بندی روش‌ها',
                        'url' => ['/']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/']
                    ]
                ]
            ],
            [
                'label' => 'لیست منابع',
                'url' => ['/pool/investigation/reference/manage/index']
            ]
        ];
        parent::init();
    }
}
