<?php

namespace nad\engineering\construction\investigation;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\engineering\construction\investigation\source\Module',
            'proposal' => 'nad\engineering\construction\investigation\proposal\Module',
            'report' => 'nad\engineering\construction\investigation\report\Module',
            'reference' => 'nad\engineering\construction\investigation\reference\Module',
            'method' => 'nad\engineering\construction\investigation\method\Module'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'لیست‌ منشا',
                        'url' => ['/engineering/construction/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['/engineering/construction/investigation/source/manage/create']
                    ]
                ]
            ],
            [
                'label' => 'لیست پروپوزال',
                'url' => ['/engineering/construction/investigation/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش',
                        'url' => ['/engineering/construction/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/engineering/construction/investigation/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/engineering/construction/investigation/report/manage/generate-graph']
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'لیست روش‌ها',
                        'url' => ['/engineering/construction/investigation/method/manage/index']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/engineering/construction/investigation/method/manage/create']
                    ]
                ]
            ],
            [
                'label' => 'لیست منابع',
                'url' => ['/engineering/construction/investigation/reference/manage/index']
            ]
        ];
        parent::init();
    }
}
