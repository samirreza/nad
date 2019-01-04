<?php

namespace nad\engineering\equipment;

class Module extends \yii\base\Module
{
    public function init()
    {
        $this->modules = [
            'type' => 'nad\engineering\equipment\modules\type\Module',
            'document' => 'nad\engineering\equipment\modules\document\Module'
        ];
        parent::init();
    }
}
