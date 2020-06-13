<?php

namespace nad\process\materials\alkalineWasher;

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
                            //'roles' => ['alkalineWasher.investigation']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor'
                            ],
                            'roles' => ['@']
                            //'roles' => ['alkalineWasher.investigationMonitor']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-design'
                            ],
                            'roles' => ['@']
                            //'roles' => ['alkalineWasher.investigationDesign']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/process/materials/alkalineWasher/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/materials/alkalineWasher/investigation');
    }

    public function actionInvestigationMonitor()
    {
        return $this->render('@nad/process/materials/alkalineWasher/investigationMonitor');
    }

    public function actionInvestigationDesign()
    {
        return $this->render('@nad/process/materials/alkalineWasher/investigationDesign');
    }
}
