<?php

namespace nad\rla;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public function init()
    {
        // $this->modules = [
        //     'investigation' => 'nad\research\investigation\Module',
        // ];

        $this->horizontalMenuItems = [
            [
                'label' => 'لیست داده گاه ها',
                'url' => ['manage/grant-revoke-preview']
            ],
            [
                'label' => 'مدارک',
                'url' =>  ['manage/index']
            ],
            [
                'label' => 'درخواست ها',
                'url' =>  ['request/index']
            ],
        ];
        parent::init();
    }
}
