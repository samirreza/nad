<?php
namespace nad\engineering\electricity\site;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $department = 'فنی';
    public $pluralLabel = 'مدارک';
    public $singularLabel = 'مدرک';

    public $defaultRoute = 'manage/index';

    public function init()
    {
        $this->horizontalMenuItems = [
            [
                'label' => 'مکانها',
                'items' => [
                    [
                        'label' => 'لیست مکانها',
                        'url' => ['/engineering/electricity/site/site/index']
                    ],
                    [
                        'label' => 'افزودن مکان و تجهیز',
                        'url' => ['/engineering/electricity/site/site/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];

        parent::init();
    }
}
