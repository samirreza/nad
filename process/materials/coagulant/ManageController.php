<?php

namespace nad\process\materials\coagulant;

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
                            //'roles' => ['coagulant.investigation']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor'
                            ],
                            'roles' => ['@']
                            //'roles' => ['coagulant.investigationMonitor']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-design'
                            ],
                            'roles' => ['@']
                            //'roles' => ['coagulant.investigationDesign']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/process/materials/coagulant/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/materials/coagulant/investigation');
    }

    public function actionInvestigationMonitor()
    {
        return $this->render('@nad/process/materials/coagulant/investigationMonitor');
    }

    public function actionInvestigationDesign()
    {
        return $this->render('@nad/process/materials/coagulant/investigationDesign');
    }
}
