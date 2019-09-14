<?php

namespace nad\process\ird\sedimentation\investigation;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\ird\sedimentation\investigation\source\Module',
            'proposal' => 'nad\process\ird\sedimentation\investigation\proposal\Module',
            'report' => 'nad\process\ird\sedimentation\investigation\report\Module',
            'reference' => 'nad\process\ird\sedimentation\investigation\reference\Module',
            'method' => 'nad\process\ird\sedimentation\investigation\method\Module'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'لیست‌ منشا',
                        'url' => ['/sedimentation/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['/sedimentation/investigation/source/manage/create']
                    ]
                ]
            ],
            [
                'label' => 'لیست پروپوزال',
                'url' => ['/sedimentation/investigation/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش',
                        'url' => ['/sedimentation/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/sedimentation/investigation/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/sedimentation/investigation/report/manage/generate-graph']
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'لیست روش‌ها',
                        'url' => ['/sedimentation/investigation/method/manage/index']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/sedimentation/investigation/method/manage/create']
                    ]
                ]
            ],
            [
                'label' => 'لیست منابع',
                'url' => ['/sedimentation/investigation/reference/manage/index']
            ]
        ];
        parent::init();
    }
}
