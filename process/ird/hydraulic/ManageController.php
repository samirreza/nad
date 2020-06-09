<?php

namespace nad\process\ird\hydraulic;

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
                            //'roles' => ['hydraulic.investigation']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor'
                            ],
                            'roles' => ['@']
                            //'roles' => ['hydraulic.investigationMonitor']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-design'
                            ],
                            'roles' => ['@']
                            //'roles' => ['hydraulic.investigationDesign']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/process/ird/hydraulic/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/hydraulic/investigation');
    }

    public function actionInvestigationMonitor()
    {
        return $this->render('@nad/process/ird/hydraulic/investigationMonitor');
    }

    public function actionInvestigationDesign()
    {
        return $this->render('@nad/process/ird/hydraulic/investigationDesign');
    }
}
