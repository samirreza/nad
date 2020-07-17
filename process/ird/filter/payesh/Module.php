<?php
namespace nad\process\ird\filter\payesh;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'لوله کشی  - مراحل - پایش';
    public $department = 'فنی';
    public $pluralLabel = 'مراحل';
    public $singularLabel = 'مرحله';

    // public $categoryListBtnLabel = 'لیست مراحل';
    // public $categoryCreateBtnLabel = 'افزودن رده مراحل';

    public $defaultRoute = 'manage/index';

    public function init()
    {
        $this->modules = [
            'excelmanager' => 'nad\process\ird\filter\payesh\excelmanager\Module',
            // 'investigationMonitorMethods' => 'nad\process\ird\filter\investigationMonitorMethods\Module',
            // 'investigationDesign' => 'nad\process\ird\filter\investigationDesign\Module',
        ];

        $this->horizontalMenuItems = [];

        parent::init();
    }
}
