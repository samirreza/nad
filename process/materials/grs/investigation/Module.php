<?php

namespace nad\process\materials\grs\investigation;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\materials\grs\investigation\source\Module',
            'proposal' => 'nad\process\materials\grs\investigation\proposal\Module',
            'report' => 'nad\process\materials\grs\investigation\report\Module',
            'reference' => 'nad\process\materials\grs\investigation\reference\Module',
            'method' => 'nad\process\materials\grs\investigation\method\Module'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['/grs/investigation/source/manage/create']
                    ],
                    [
                        'label' => 'لیست‌ منشاهای برنامه',
                        'url' => ['/grs/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'لیست رده های منشا',
                        'url' => ['/grs/investigation/source/category/index']
                    ],
                ]
            ],
            [
                'label' => 'لیست پروپوزال',
                'url' => ['/grs/investigation/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش',
                        'url' => ['/grs/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/grs/investigation/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/grs/investigation/report/manage/generate-graph']
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'لیست روش‌ها',
                        'url' => ['/grs/investigation/method/manage/index']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/grs/investigation/method/manage/create']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
