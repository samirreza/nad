<?php

namespace nad\process\ird\filter\investigation;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\ird\filter\investigation\source\Module',
            'proposal' => 'nad\process\ird\filter\investigation\proposal\Module',
            'report' => 'nad\process\ird\filter\investigation\report\Module',
            'reference' => 'nad\process\ird\filter\investigation\reference\Module',
            'method' => 'nad\process\ird\filter\investigation\method\Module'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['/filter/investigation/source/manage/create']
                    ],
                    [
                        'label' => 'لیست‌ منشاهای برنامه',
                        'url' => ['/filter/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'لیست رده های منشا',
                        'url' => ['/filter/investigation/source/category/index']
                    ],
                ]
            ],
            [
                'label' => 'لیست پروپوزال',
                'url' => ['/filter/investigation/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش',
                        'url' => ['/filter/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/filter/investigation/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/filter/investigation/report/manage/generate-graph']
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'لیست روش‌ها',
                        'url' => ['/filter/investigation/method/manage/index']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/filter/investigation/method/manage/create']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
