<?php

namespace nad\process\materials\antisediment;

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
                            //'roles' => ['antisediment.investigation']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor'
                            ],
                            'roles' => ['@']
                            //'roles' => ['antisediment.investigationMonitor']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-design'
                            ],
                            'roles' => ['@']
                            //'roles' => ['antisediment.investigationDesign']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/process/materials/antisediment/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/materials/antisediment/investigation');
    }

    public function actionInvestigationMonitor()
    {
        return $this->render('@nad/process/materials/antisediment/investigationMonitor');
    }

    public function actionInvestigationDesign()
    {
        return $this->render('@nad/process/materials/antisediment/investigationDesign');
    }
}
