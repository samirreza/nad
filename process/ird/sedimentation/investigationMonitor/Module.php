<?php

namespace nad\process\ird\sedimentation\investigationMonitor;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\ird\sedimentation\investigationMonitor\source\Module',
            'proposal' => 'nad\process\ird\sedimentation\investigationMonitor\proposal\Module',
            'report' => 'nad\process\ird\sedimentation\investigationMonitor\report\Module',
            'reference' => 'nad\process\ird\sedimentation\investigationMonitor\reference\Module',
            'method' => 'nad\process\ird\sedimentation\investigationMonitor\method\Module'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['/sedimentation/investigationMonitor/source/manage/create']
                    ],
                    [
                        'label' => 'لیست‌ منشاهای برنامه',
                        'url' => ['/sedimentation/investigationMonitor/source/manage/index']
                    ],
                    [
                        'label' => 'لیست رده های منشا',
                        'url' => ['/sedimentation/investigationMonitor/source/category/index']
                    ],
                ]
            ],
            [
                'label' => 'لیست پروپوزال',
                'url' => ['/sedimentation/investigationMonitor/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش',
                        'url' => ['/sedimentation/investigationMonitor/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/sedimentation/investigationMonitor/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/sedimentation/investigationMonitor/report/manage/generate-graph']
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'لیست روش‌ها',
                        'url' => ['/sedimentation/investigationMonitor/method/manage/index']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/sedimentation/investigationMonitor/method/manage/create']
                    ]
                ]
            ]
        ];
        parent::init();
    }
}
