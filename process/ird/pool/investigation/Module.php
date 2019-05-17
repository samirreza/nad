<?php

namespace nad\process\ird\pool\investigation;

class Module extends \yii\base\Module
{
    public function init()
    {
        $this->modules = [
            'source' => 'nad\process\ird\pool\investigation\source\Module'
        ];
        parent::init();
    }
}
