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
            'source' => [
                'label' => 'منشا‌ها',
                'url' => ['/research/investigation/source/manage/index']
            ],
            'proposal' => [
                'label' => 'پروپوزال‌ها',
                'url' => ['/research/investigation/proposal/manage/index']
            ],
            'project' => [
                'label' => 'گزارش‌ها',
                'url' => ['/research/investigation/project/manage/index']
            ],
            'resource' => [
                'label' => 'منابع',
                'url' => ['/research/investigation/resource']
            ]
        ];
        parent::init();
    }
}
