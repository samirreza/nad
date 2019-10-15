<?php

namespace nad\process\materials\disinfectant;

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
                            'roles' => ['disinfectant.investigation']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor'
                            ],
                            'roles' => ['disinfectant.investigationMonitor']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/process/materials/disinfectant/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/materials/disinfectant/investigation');
    }

    public function actionInvestigationMonitor()
    {
        return $this->render('@nad/process/materials/disinfectant/investigationMonitor');
    }
}