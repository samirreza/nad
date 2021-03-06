<?php

namespace nad\process\ird\sedimentation;

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
                            'roles' => ['@']
                            //'roles' => ['sedimentation.investigation']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor'
                            ],
                            'roles' => ['@']
                            //'roles' => ['sedimentation.investigationMonitor']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'payesh'
                            ],
                            'roles' => ['@']
                            //'roles' => ['cartridge.payesh']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/process/ird/sedimentation/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/sedimentation/investigation');
    }

    public function actionInvestigationMonitor()
    {
        return $this->render('@nad/process/ird/sedimentation/investigationMonitor');
    }

    public function actionPayesh()
    {
        return $this->render('@nad/process/ird/sedimentation/payesh');
    }
}
