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
                'label' => 'پروپوزال',
                'url' => ['/pool/investigation/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش‌ها',
                        'url' => ['/pool/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/pool/investigation/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/pool/investigation/report/manage/generate-graph'],                        
                        // 'visible' => Yii::$app->user->can('research.manage')
                    ],

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
                        'label' => 'رده‌بندی روش‌ها',
                        'url' => ['/']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/']
                    ],
                    [
                        'label' => 'افزودن رده',
                        'url' => ['/']
                    ]
                ]
            ],
            [
                'label' => 'منابع',
                'url' => ['/pool/investigation/reference/manage/index']
            ]
        ];
        parent::init();
    }
}
