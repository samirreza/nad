<?php

namespace nad\process\ird;

class Module extends \yii\base\Module
{
    public $title = 'فرایندها';
    public $defaultRoute = 'manage/index';
    public $controllerNamespace = 'nad\process\ird';

    public function init()
    {
        $this->modules = [
            'cartridge' => 'nad\process\ird\cartridge\Module',
            'filter' => 'nad\process\ird\filter\Module',
            'graphene' => 'nad\process\ird\graphene\Module',
            'introduction' => 'nad\process\ird\introduction\Module',
            'microbial' => 'nad\process\ird\microbial\Module',
            'newTechnology' => 'nad\process\ird\newTechnology\Module',
            'hydraulic' => 'nad\process\ird\hydraulic\Module',
            'heattransfer' => 'nad\process\ird\heattransfer\Module',
            // 'pool' => 'nad\process\ird\pool\Module',
            'ro' => 'nad\process\ird\ro\Module',
            'sedimentation' => 'nad\process\ird\sedimentation\Module',
            'wastewater' => 'nad\process\ird\wastewater\Module',
        ];
        parent::init();
    }
}
