<?php
namespace nad\engineering\instrument\stage;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'ابزار دقیق  - مراحل';
    public $department = 'فنی';
    public $pluralLabel = 'مراحل';
    public $singularLabel = 'مرحله';

    public $categoryListBtnLabel = 'لیست مراحل';
    public $categoryCreateBtnLabel = 'افزودن رده مراحل';

    public $defaultRoute = 'manage/index';

    public function init()
    {
        $this->modules = [
            'investigationImprovement' => 'nad\engineering\instrument\stage\investigationImprovement\Module',
            // 'investigationMonitorMethods' => 'nad\engineering\instrument\stage\investigationMonitorMethods\Module',
            // 'investigationDesign' => 'nad\engineering\instrument\stage\investigationDesign\Module',
        ];

        $this->horizontalMenuItems = [
            [
                'label' => 'مراحل',
                'items' => [
                    [
                        'label' => 'لیست مراحل',
                        'url' => ['/engineering/instrument/stage/category/index']
                    ],
                    [
                        'label' => 'افزودن مرحله',
                        'url' => ['/engineering/instrument/stage/category/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];

        parent::init();
    }
}
