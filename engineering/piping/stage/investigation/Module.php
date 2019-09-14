<?php

namespace nad\engineering\piping\stage\investigation;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        $this->modules = [
            'source' => 'nad\engineering\piping\stage\investigation\source\Module',
            'proposal' => 'nad\engineering\piping\stage\investigation\proposal\Module',
            'report' => 'nad\engineering\piping\stage\investigation\report\Module',
            'reference' => 'nad\engineering\piping\stage\investigation\reference\Module',
            'method' => 'nad\engineering\piping\stage\investigation\method\Module'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'لیست‌ منشا',
                        'url' => ['/engineering/piping/stage/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'افزودن منشا',
                        'url' => ['/engineering/piping/stage/investigation/source/manage/create']
                    ]
                ]
            ],
            [
                'label' => 'لیست پروپوزال',
                'url' => ['/engineering/piping/stage/investigation/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌',
                'items' => [
                    [
                        'label' => 'لیست گزارش',
                        'url' => ['/engineering/piping/stage/investigation/report/manage/index']
                    ],
                    [
                        'label' => 'رده‌بندی گزارش‌ها',
                        'url' => ['/engineering/piping/stage/investigation/report/category/index']
                    ],
                    [
                        'label' => 'گراف گزارش ها',
                        'url' => ['/engineering/piping/stage/investigation/report/manage/generate-graph']
                    ]
                ]
            ],
            [
                'label' => 'روش',
                'items' => [
                    [
                        'label' => 'لیست روش‌ها',
                        'url' => ['/engineering/piping/stage/investigation/method/manage/index']
                    ],
                    [
                        'label' => 'افزودن روش',
                        'url' => ['/engineering/piping/stage/investigation/method/manage/create']
                    ]
                ]
            ],
            [
                'label' => 'لیست منابع',
                'url' => ['/engineering/piping/stage/investigation/reference/manage/index']
            ]
        ];
        parent::init();
    }
}
