<?php

namespace nad\process\materials\grs\investigationMonitor;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\materials\grs\investigationMonitor\source\Module',
            'proposal' => 'nad\process\materials\grs\investigationMonitor\proposal\Module',
            'report' => 'nad\process\materials\grs\investigationMonitor\report\Module',
            'reference' => 'nad\process\materials\grs\investigationMonitor\reference\Module',
            'method' => 'nad\process\materials\grs\investigationMonitor\method\Module'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['/grs/investigationMonitor/source/manage/create']
                    ],
                    [
                        'label' => 'لیست‌ منشاهای برنامه',
                        'url' => ['/grs/investigationMonitor/source/manage/index']
                    ],
                    [
                        'label' => 'لیست رده های منشا',
                        'url' => ['/grs/investigationMonitor/source/category/index']
                    ],
                ]
            ],
            [
                'label' => 'لیست پروپوزال',
                'url' => ['/grs/investigationMonitor/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش',
                        'url' => ['/grs/investigationMonitor/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/grs/investigationMonitor/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/grs/investigationMonitor/report/manage/generate-graph']
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'لیست روش‌ها',
                        'url' => ['/grs/investigationMonitor/method/manage/index']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/grs/investigationMonitor/method/manage/create']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
