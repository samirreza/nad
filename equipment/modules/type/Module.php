<?php
namespace modules\nad\equipment\modules\type;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        $this->modules = [
            'details' => [
                'class' => 'modules\nad\equipment\modules\type\details\Module',
            ],
        ];
    }
}
