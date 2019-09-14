<?php

namespace nad\process\ird\graphene\investigation;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\ird\graphene\investigation\source\Module',
            'proposal' => 'nad\process\ird\graphene\investigation\proposal\Module',
            'report' => 'nad\process\ird\graphene\investigation\report\Module',
            'reference' => 'nad\process\ird\graphene\investigation\reference\Module',
            'method' => 'nad\process\ird\graphene\investigation\method\Module'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'لیست‌ منشا',
                        'url' => ['/graphene/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['/graphene/investigation/source/manage/create']
                    ]
                ]
            ],
            [
                'label' => 'لیست پروپوزال',
                'url' => ['/graphene/investigation/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش',
                        'url' => ['/graphene/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/graphene/investigation/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/graphene/investigation/report/manage/generate-graph']
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'لیست روش‌ها',
                        'url' => ['/graphene/investigation/method/manage/index']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/graphene/investigation/method/manage/create']
                    ]
                ]
            ],
            [
                'label' => 'لیست منابع',
                'url' => ['/graphene/investigation/reference/manage/index']
            ]
        ];
        parent::init();
    }
}
