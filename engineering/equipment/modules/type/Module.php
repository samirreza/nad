<?php

namespace nad\engineering\equipment\modules\type;

class Module extends \yii\base\Module
{
    public function init()
    {
        $this->modules = [
            'details' => 'nad\engineering\equipment\modules\type\details\Module'
        ];
        parent::init();
    }
}
