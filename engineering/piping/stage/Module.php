<?php
namespace nad\engineering\piping\stage;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'لوله کشی  - مراحل';
    public $department = 'فنی';
    public $pluralLabel = 'مراحل';
    public $singularLabel = 'مرحله';

    public $categoryListBtnLabel = 'لیست مراحل';
    public $categoryCreateBtnLabel = 'افزودن رده مراحل';

    public $defaultRoute = 'manage/index';

    public function init()
    {
        $this->modules = [
            'investigationImprovement' => 'nad\engineering\piping\stage\investigationImprovement\Module',
            'payesh' => 'nad\engineering\piping\stage\payesh\Module',
            'investigation4' => 'nad\engineering\piping\stage\investigation4\Module',
            // 'investigationMonitorMethods' => 'nad\engineering\piping\stage\investigationMonitorMethods\Module',
            // 'investigationDesign' => 'nad\engineering\piping\stage\investigationDesign\Module',
        ];

        $this->horizontalMenuItems = [
            [
                'label' => 'مراحل',
                'items' => [
                    [
                        'label' => 'لیست مراحل',
                        'url' => ['/engineering/piping/stage/category/index']
                    ],
                    [
                        'label' => 'افزودن مرحله',
                        'url' => ['/engineering/piping/stage/category/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];

        parent::init();
    }
}
