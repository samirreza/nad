<?php
namespace nad\engineering\piping\location;

class Module extends \yii\base\Module
{
    public $department = 'فنی';
    public $pluralLabel = 'مکان ها';
    public $singularLabel = 'مکان';

    public $defaultRoute = 'manage/index';
}
