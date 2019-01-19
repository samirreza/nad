<?php

namespace nad\research\investigation;

class Module extends \yii\base\Module
{
    public $horizontalButtons;

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
        $this->horizontalButtons = [
            [
                'label' => 'منشا',
                'items' => [
                    [
                        'label' => 'منشا‌ها',
                        'url' => ['/research/investigation/source/manage/index']
                    ],
                    [
                        'label' => 'درج منشا',
                        'url' => ['/research/investigation/source/manage/create']
                    ]
                ]
            ],
            [
                'label' => 'پروپوزال',
                'url' => ['/research/investigation/proposal/manage/index']
            ],
            [
                'label' => 'گزارش',
                'url' => ['/research/investigation/project/manage/index']
            ],
            [
                'label' => 'منابع',
                'url' => ['/research/investigation/resource']
            ]
        ];
        parent::init();
    }
}
