<?php
namespace nad\engineering\electricity\device\device;

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
                        'url' => ['/engineering/electricity/device/device/manage/index']
                    ],
                    [
                        'label' => 'افزودن تجهیز',
                        'url' => ['/engineering/electricity/device/device/manage/index#class_ajaxcreate']
                    ],
                    [
                        'label' => 'افزودن رده',
                        'url' => ['/engineering/electricity/device/device/category/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];

        parent::init();
    }
}
