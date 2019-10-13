<?php

namespace nad\process\ird\microbial\investigation\reference;

use nad\process\ird\microbial\investigation\Module as BaseModule;

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
                        'url' => ['/microbial/investigation/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/microbial/investigation/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
