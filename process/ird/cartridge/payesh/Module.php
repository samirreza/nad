<?php
namespace nad\process\ird\cartridge\payesh;

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
            'excelmanager' => 'nad\process\ird\cartridge\payesh\excelmanager\Module',
            // 'investigationMonitorMethods' => 'nad\process\ird\cartridge\investigationMonitorMethods\Module',
            // 'investigationDesign' => 'nad\process\ird\cartridge\investigationDesign\Module',
        ];

        $this->horizontalMenuItems = [];

        parent::init();
    }
}
