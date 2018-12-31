<?php

namespace nad\research;

use Yii;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;

    public function init()
    {
        Yii::configure($this, require(__DIR__ . '/config.php'));
        $this->modules = [
            'source' => [
                'class' => 'nad\research\modules\source\Module'
            ],
            'proposal' => [
                'class' => 'nad\research\modules\proposal\Module'
            ],
            'project' => [
                'class' => 'nad\research\modules\project\Module'
            ],
            'lab' => 'nad\research\lab\Module',
            'resource' => [
                'class' => 'nad\research\modules\resource\Module'
            ],
            'material' => [
                'class' => 'nad\research\modules\material\Module'
            ]
        ];
        parent::init();
    }
}
