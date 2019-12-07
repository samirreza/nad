<?php
namespace nad\engineering\piping\device\device;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $department = 'فنی';
    public $pluralLabel = 'تجهیزات';
    public $singularLabel = 'تجهیز';

    public $defaultRoute = 'manage/index';

    public function init()
    {
        $this->horizontalMenuItems = [
            [
                'label' => 'تجهیزات',
                'items' => [
                    [
                        'label' => 'لیست تجهیزات',
                        'url' => ['/engineering/piping/device/device/manage/index']
                    ],
                    [
                        'label' => 'افزودن تجهیز',
                        'url' => ['/engineering/piping/device/device/manage/index#class_ajaxcreate']
                    ],
                    [
                        'label' => 'افزودن رده',
                        'url' => ['/engineering/piping/device/device/category/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];

        parent::init();
    }
}
