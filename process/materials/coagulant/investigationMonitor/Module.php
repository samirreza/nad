<?php

namespace nad\process\materials\coagulant\investigationMonitor;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\materials\coagulant\investigationMonitor\source\Module',
            'proposal' => 'nad\process\materials\coagulant\investigationMonitor\proposal\Module',
            'report' => 'nad\process\materials\coagulant\investigationMonitor\report\Module',
            'reference' => 'nad\process\materials\coagulant\investigationMonitor\reference\Module',
            'method' => 'nad\process\materials\coagulant\investigationMonitor\method\Module'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['/coagulant/investigationMonitor/source/manage/create']
                    ],
                    [
                        'label' => 'لیست‌ منشاهای برنامه',
                        'url' => ['/coagulant/investigationMonitor/source/manage/index']
                    ],
                    [
                        'label' => 'لیست رده های منشا',
                        'url' => ['/coagulant/investigationMonitor/source/category/index']
                    ],
                ]
            ],
            [
                'label' => 'لیست پروپوزال',
                'url' => ['/coagulant/investigationMonitor/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش',
                        'url' => ['/coagulant/investigationMonitor/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/coagulant/investigationMonitor/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/coagulant/investigationMonitor/report/manage/generate-graph']
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'لیست روش‌ها',
                        'url' => ['/coagulant/investigationMonitor/method/manage/index']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/coagulant/investigationMonitor/method/manage/create']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
