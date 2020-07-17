<?php
namespace nad\engineering\piping\stage\payesh;

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
            'excelmanager' => 'nad\engineering\piping\stage\payesh\excelmanager\Module',
            // 'investigationMonitorMethods' => 'nad\engineering\piping\stage\investigationMonitorMethods\Module',
            // 'investigationDesign' => 'nad\engineering\piping\stage\investigationDesign\Module',
        ];

        $this->horizontalMenuItems = [];

        parent::init();
    }
}
