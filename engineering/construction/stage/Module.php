<?php
namespace nad\engineering\construction\stage;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'ساختمان  - مراحل';
    public $department = 'فنی';
    public $pluralLabel = 'مراحل';
    public $singularLabel = 'مرحله';

    public $categoryListBtnLabel = 'لیست مراحل';
    public $categoryCreateBtnLabel = 'افزودن رده مراحل';

    public $defaultRoute = 'manage/index';

    public function init()
    {
        $this->modules = [
            'investigationImprovement' => 'nad\engineering\construction\stage\investigationImprovement\Module',
            // 'investigationMonitorMethods' => 'nad\engineering\construction\stage\investigationMonitorMethods\Module',
            // 'investigationDesign' => 'nad\engineering\construction\stage\investigationDesign\Module',
        ];

        $this->horizontalMenuItems = [
            [
                'label' => 'مراحل',
                'items' => [
                    [
                        'label' => 'لیست مراحل',
                        'url' => ['/engineering/construction/stage/category/index']
                    ],
                    [
                        'label' => 'افزودن مرحله',
                        'url' => ['/engineering/construction/stage/category/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];

        parent::init();
    }
}
