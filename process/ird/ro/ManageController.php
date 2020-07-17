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
                            'roles' => ['@']
                            //'roles' => ['ro.investigation']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor'
                            ],
                            'roles' => ['@']
                            //'roles' => ['ro.investigationMonitor']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-design'
                            ],
                            'roles' => ['@']
                            //'roles' => ['ro.investigationDesign']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'payesh'
                            ],
                            'roles' => ['@']
                            //'roles' => ['ro.payesh']
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

    public function actionInvestigationDesign()
    {
        return $this->render('@nad/process/ird/ro/investigationDesign');
    }

    public function actionPayesh()
    {
        return $this->render('@nad/process/ird/ro/payesh');
    }
}
