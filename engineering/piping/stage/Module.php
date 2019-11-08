<?php
namespace nad\engineering\piping\stage;

class Module extends \yii\base\Module
{
    public $horizontalMenuItems;

    public $department = 'فنی';
    public $pluralLabel = 'مراحل';
    public $singularLabel = 'مرحله';

    public $categoryListBtnLabel = 'لیست مراحل';
    public $categoryCreateBtnLabel = 'افزودن رده مراحل';

    public $defaultRoute = 'manage/start';

    public function init()
    {

        $this->horizontalMenuItems = [
            [
                'label' => 'مراحل',
                'items' => [
                    [
                        'label' => 'لیست مراحل',
                        'url' => ['/engineering/piping/stage/category/index']
                    ],
                    [
                        'label' => 'افزودن مرحله',
                        'url' => ['/engineering/piping/stage/category/index#class_ajaxcreate']
                    ]
                ]
            ]
        ];

        parent::init();
    }
}
