<?php

namespace nad\research;

use Yii;

class Module extends \yii\base\Module
{
    public $title;
    public $menu;
    public $defaultRoute = 'expert/manage/index';

    public function init()
    {
        Yii::configure($this, require(__DIR__ . '/config.php'));
        $this->modules = [
            'expert' => [
                'class' => 'nad\research\modules\expert\Module'
            ],
            'source' => [
                'class' => 'nad\research\modules\source\Module'
            ],
            'proposal' => [
                'class' => 'nad\research\modules\proposal\Module'
            ],
            'project' => [
                'class' => 'nad\research\modules\project\Module'
            ]
        ];
        parent::init();
    }
}
