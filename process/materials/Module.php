<?php

namespace nad\process\materials;

class Module extends \yii\base\Module
{
    public $title = 'مواد';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\materials';

    public function init()
    {
        $this->modules = [
            'alkalineWasher' => 'nad\process\materials\alkalineWasher\Module',
            'acidicWasher' => 'nad\process\materials\acidicWasher\Module',
            'disinfectant' => 'nad\process\materials\disinfectant\Module',
            'coagulant' => 'nad\process\materials\coagulant\Module',
            'grs' => 'nad\process\materials\grs\Module',
            'antisediment' => 'nad\process\materials\antisediment\Module',
            'antimicrobial' => 'nad\process\materials\antimicrobial\Module',
            'colors' => 'nad\process\materials\colors\Module',
            'lacquer' => 'nad\process\materials\lacquer\Module',
        ];
        parent::init();
    }
}
