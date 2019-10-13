<?php

namespace nad\process\ird\cartridge\investigation\reference;

use nad\process\ird\cartridge\investigation\Module as BaseModule;

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
                        'url' => ['/cartridge/investigation/reference/manage/index']
                    ],
                    [
                        'label' => 'افزودن منبع',
                        'url' => ['/cartridge/investigation/reference/manage/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];
    }
}
