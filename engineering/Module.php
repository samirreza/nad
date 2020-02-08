<?php

namespace nad\engineering;

use Yii;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;

    public function init()
    {
        Yii::configure($this, require(__DIR__ . '/config.php'));
        $this->modules = [
            'piping' => 'nad\engineering\piping\Module',
            // 'plant' => 'nad\engineering\plant\Module',
            // 'resource' => 'nad\engineering\resource\Module',
            'construction' => 'nad\engineering\construction\Module',
            'control' => 'nad\engineering\control\Module',
            'electricity' => 'nad\engineering\electricity\Module',
            'instrument' => 'nad\engineering\instrument\Module',
            'mechanics' => 'nad\engineering\mechanics\Module',
            'geotechnics' => 'nad\engineering\geotechnics\Module',
            // 'location' => 'nad\engineering\location\Module',
            // 'document' => 'nad\engineering\document\Module',
            // 'equipment' => 'nad\engineering\equipment\Module',
            // 'stage' => 'nad\engineering\stage\Module',
        ];
        parent::init();
    }
}
