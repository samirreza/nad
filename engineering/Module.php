<?php
namespace nad\engineering;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;

    public function init()
    {
        parent::init();
        $this->modules = [
            'plant' => 'nad\engineering\plant\Module',
            'resource' => 'nad\engineering\resource\Module',
            'location' => 'nad\engineering\location\Module',
            'document' => 'nad\engineering\document\Module',
        ];
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
