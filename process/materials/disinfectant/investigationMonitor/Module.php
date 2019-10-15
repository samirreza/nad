<?php

namespace nad\process\materials\disinfectant\investigationMonitor;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\materials\disinfectant\investigationMonitor\source\Module',
            'proposal' => 'nad\process\materials\disinfectant\investigationMonitor\proposal\Module',
            'report' => 'nad\process\materials\disinfectant\investigationMonitor\report\Module',
            'reference' => 'nad\process\materials\disinfectant\investigationMonitor\reference\Module',
            'method' => 'nad\process\materials\disinfectant\investigationMonitor\method\Module'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['/disinfectant/investigationMonitor/source/manage/create']
                    ],
                    [
                        'label' => 'لیست‌ منشاهای برنامه',
                        'url' => ['/disinfectant/investigationMonitor/source/manage/index']
                    ],
                    [
                        'label' => 'لیست رده های منشا',
                        'url' => ['/disinfectant/investigationMonitor/source/category/index']
                    ],
                ]
            ],
            [
                'label' => 'لیست پروپوزال',
                'url' => ['/disinfectant/investigationMonitor/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش',
                        'url' => ['/disinfectant/investigationMonitor/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/disinfectant/investigationMonitor/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/disinfectant/investigationMonitor/report/manage/generate-graph']
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'لیست روش‌ها',
                        'url' => ['/disinfectant/investigationMonitor/method/manage/index']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/disinfectant/investigationMonitor/method/manage/create']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
