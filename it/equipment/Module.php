<?php
namespace nad\it\equipment;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        $this->modules = [
            'type' => [
                'class' => 'nad\it\equipment\type\Module',
            ],
        ];
    }
}
