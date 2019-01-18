<?php

namespace nad\research\investigation\proposal;

class Module extends \yii\base\Module
{
    public $defaultRoute = 'manage/index';
    public $horizontalButtons;

    public function init()
    {
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
