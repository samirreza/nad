<?php
namespace nad\engineering\piping\stage;

class Module extends \yii\base\Module
{
    public $department = 'فنی';
    public $pluralLabel = 'مراحل';
    public $singularLabel = 'مرحله';

    public $defaultRoute = 'manage/index';
}
