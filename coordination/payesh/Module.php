<?php
namespace nad\coordination\payesh;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $title = 'مدیریت - هماهنگی - پایش';
    public $department = 'مدیریت - هماهنگی';
    public $pluralLabel = 'پایش';
    public $singularLabel = 'پایش';

    // public $categoryListBtnLabel = 'لیست مراحل';
    // public $categoryCreateBtnLabel = 'افزودن رده مراحل';

    public $defaultRoute = 'manage/index';

    public function init()
    {
        $this->modules = [
            'excelmanager' => 'nad\coordination\payesh\excelmanager\Module',
        ];

        $this->horizontalMenuItems = [];

        parent::init();
    }
}
