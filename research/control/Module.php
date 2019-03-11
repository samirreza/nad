<?php

namespace nad\research\control;

class Module extends \yii\base\Module
{
    public function init()
    {
        $this->modules = [
            'material' => 'nad\research\control\material\Module'
        ];
    }
}
