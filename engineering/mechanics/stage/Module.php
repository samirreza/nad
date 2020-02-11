<?php
namespace nad\engineering\mechanics\stage;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'مکانیک  - مراحل';
    public $department = 'فنی';
    public $pluralLabel = 'مراحل';
    public $singularLabel = 'مرحله';

    public $categoryListBtnLabel = 'لیست مراحل';
    public $categoryCreateBtnLabel = 'افزودن رده مراحل';

    public $defaultRoute = 'manage/index';

    public function init()
    {
        $this->modules = [
            'investigationImprovement' => 'nad\engineering\mechanics\stage\investigationImprovement\Module',
            // 'investigationMonitorMethods' => 'nad\engineering\mechanics\stage\investigationMonitorMethods\Module',
            // 'investigationDesign' => 'nad\engineering\mechanics\stage\investigationDesign\Module',
        ];

        $this->horizontalMenuItems = [
            [
                'label' => 'مراحل',
                'items' => [
                    [
                        'label' => 'لیست مراحل',
                        'url' => ['/engineering/mechanics/stage/category/index']
                    ],
                    [
                        'label' => 'افزودن مرحله',
                        'url' => ['/engineering/mechanics/stage/category/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];

        parent::init();
    }
}
