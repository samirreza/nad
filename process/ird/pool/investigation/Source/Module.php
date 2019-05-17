<?php

namespace nad\process\ird\pool\investigation\source;

class Module extends \yii\base\Module
{
    public $defaultRoute = 'manage/index';
    public $horizontalMenuItems;

    public function init()
    {
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'لیست‌ منشا',
                        'url' => ['index']
                    ],
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['create']
                    ]
                ]
            ],
            [
                'label' => 'پروپوزال',
                'items' => [
                    [
                        'label' => 'لیست‌ پروپوزال',
                        'url' => ['/']
                    ]
                ]
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش‌ها',
                        'url' => ['/']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/']
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
                'items' => [
                    [
                        'label' => 'لیست منابع',
                        'url' => ['/']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/']
                    ]
                ]
            ],
        ];
        parent::init();
    }
}
