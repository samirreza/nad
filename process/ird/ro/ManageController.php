<?php

namespace nad\process\ird\ro;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

class ManageController extends \yii\web\Controller
{
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
                                'investigation'
                            ],
                            'roles' => ['ro.investigation']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor'
                            ],
                            'roles' => ['ro.investigationMonitor']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/process/ird/ro/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/ro/investigation');
    }

    public function actionInvestigationMonitor()
    {
        return $this->render('@nad/process/ird/ro/investigationMonitor');
    }
}
