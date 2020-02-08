<?php
namespace nad\engineering\geotechnics\stage;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'ژئوتکنیک  - مراحل';
    public $department = 'فنی';
    public $pluralLabel = 'مراحل';
    public $singularLabel = 'مرحله';

    public $categoryListBtnLabel = 'لیست مراحل';
    public $categoryCreateBtnLabel = 'افزودن رده مراحل';

    public $defaultRoute = 'manage/index';

    public function init()
    {
        $this->modules = [
            'investigationImprovement' => 'nad\engineering\geotechnics\stage\investigationImprovement\Module',
            'investigationMonitorMethods' => 'nad\engineering\geotechnics\stage\investigationMonitorMethods\Module',
            'investigationDesign' => 'nad\engineering\geotechnics\stage\investigationDesign\Module',
        ];

        $this->horizontalMenuItems = [
            [
                'label' => 'مراحل',
                'items' => [
                    [
                        'label' => 'لیست مراحل',
                        'url' => ['/engineering/geotechnics/stage/category/index']
                    ],
                    [
                        'label' => 'افزودن مرحله',
                        'url' => ['/engineering/geotechnics/stage/category/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];

        parent::init();
    }
}
