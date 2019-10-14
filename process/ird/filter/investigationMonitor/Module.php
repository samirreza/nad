<?php

namespace nad\process\ird\filter\investigationMonitor;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\ird\filter\investigationMonitor\source\Module',
            'proposal' => 'nad\process\ird\filter\investigationMonitor\proposal\Module',
            'report' => 'nad\process\ird\filter\investigationMonitor\report\Module',
            'reference' => 'nad\process\ird\filter\investigationMonitor\reference\Module',
            'method' => 'nad\process\ird\filter\investigationMonitor\method\Module'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['/filter/investigationMonitor/source/manage/create']
                    ],
                    [
                        'label' => 'لیست‌ منشاهای برنامه',
                        'url' => ['/filter/investigationMonitor/source/manage/index']
                    ],
                    [
                        'label' => 'لیست رده های منشا',
                        'url' => ['/filter/investigationMonitor/source/category/index']
                    ],
                ]
            ],
            [
                'label' => 'لیست پروپوزال',
                'url' => ['/filter/investigationMonitor/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش',
                        'url' => ['/filter/investigationMonitor/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/filter/investigationMonitor/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/filter/investigationMonitor/report/manage/generate-graph']
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'لیست روش‌ها',
                        'url' => ['/filter/investigationMonitor/method/manage/index']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/filter/investigationMonitor/method/manage/create']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
