<?php

namespace nad\research\investigation;

use Yii;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;
    public $controllerNamespace = 'nad\research\investigation\common\controllers';

    public function init()
    {
        $this->modules = [
            'source' => 'nad\research\investigation\source\Module',
            'proposal' => 'nad\research\investigation\proposal\Module',
            'project' => 'nad\research\investigation\project\Module'
        ];
        $this->controllerMap = [
            'resource' => 'nad\research\investigation\common\controllers\ResourceController'
        ];
        $this->horizontalMenuItems = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'منشا‌ها',
                        'url' => ['/research/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'جست‌و‌جو منشا',
                        'url' => ['/research/investigation/source/manage/search']
                    ],
                    [
                        'label' => 'درج منشا',
                        'url' => ['/research/investigation/source/manage/create']
                    ]
                ]
            ],
            [
                'label' => 'پروپوزال‌ها',
                'url' => ['/research/investigation/proposal/manage/index']
            ],
            [
                'label' => 'گزارش‌ها',
                'items' => [
                    [
                        'label' => 'گزارش‌ها',
                        'url' => ['/research/investigation/project/manage/index']
                    ],
                    [
                        'label' => 'رده‌های گزارش‌ها',
                        'url' => ['/research/investigation/project/category/index'],
                        'visible' => Yii::$app->user->can('research.manage')
                    ]
                ]
            ],
            [
                'label' => 'منابع',
                'url' => ['/research/investigation/resource']
            ]
        ];
        parent::init();
    }
}
