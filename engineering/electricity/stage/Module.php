<?php
namespace nad\engineering\electricity\stage;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'برق  - مراحل';
    public $department = 'فنی';
    public $pluralLabel = 'مراحل';
    public $singularLabel = 'مرحله';

    public $categoryListBtnLabel = 'لیست مراحل';
    public $categoryCreateBtnLabel = 'افزودن رده مراحل';

    public $defaultRoute = 'manage/index';

    public function init()
    {
        $this->modules = [
            'investigationImprovement' => 'nad\engineering\electricity\stage\investigationImprovement\Module',
            // 'investigationMonitorMethods' => 'nad\engineering\electricity\stage\investigationMonitorMethods\Module',
            // 'investigationDesign' => 'nad\engineering\electricity\stage\investigationDesign\Module',
        ];

        $this->horizontalMenuItems = [
            [
                'label' => 'مراحل',
                'items' => [
                    [
                        'label' => 'لیست مراحل',
                        'url' => ['/engineering/electricity/stage/category/index']
                    ],
                    [
                        'label' => 'افزودن مرحله',
                        'url' => ['/engineering/electricity/stage/category/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];

        parent::init();
    }
}
