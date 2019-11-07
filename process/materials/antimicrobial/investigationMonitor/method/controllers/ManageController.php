<?php

namespace nad\process\materials\antimicrobial\investigationMonitor\method\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\materials\antimicrobial\investigationMonitor\method\models\Method;
use nad\process\materials\antimicrobial\investigationMonitor\method\models\MethodSearch;
use nad\common\modules\investigation\method\controllers\MethodController;

class ManageController extends MethodController
{
    public function init()
    {
        $this->modelClass = Method::class;
        $this->searchClass = MethodSearch::class;
    }

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'view',
                                'create'
                            ],
                            'roles' => ['antimicrobial.investigationMonitor']
                        ]
                    ]
                ]
            ]
        );
    }
}
