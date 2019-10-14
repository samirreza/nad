<?php

namespace nad\process\materials\alkalineWasher\investigation\reference;

use nad\process\materials\alkalineWasher\investigation\Module as BaseModule;

class Module extends BaseModule
{
    public $defaultRoute = 'manage/index';

    public function init()
    {
        parent::init();
        $this->horizontalMenuItems = [
            [
                'label' => 'داده گاه منابع',
                'items' => [
                    [
                        'label' => 'لیست داده گاه منابع',
                        'url' => ['/alkalineWasher/investigation/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/alkalineWasher/investigation/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
