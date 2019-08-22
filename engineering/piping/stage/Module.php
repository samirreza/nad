<?php
namespace nad\engineering\piping\stage;

class Module extends \yii\base\Module
{
    public $department = 'فنی';
    public $pluralLabel = 'مراحل';    
    public $singularLabel = 'مرحله';

    public $categoryListBtnLabel = 'لیست رده بندی مراحل و بسته مدارک';
    public $categoryCreateBtnLabel = 'افزودن رده مراحل و بسته مدارک';

    public $defaultRoute = 'manage/start';

    public function init()
    {                
        $this->modules = [  
            'investigation' => 'nad\engineering\piping\stage\investigation\Module', 
        ];
        parent::init();
    }
}
