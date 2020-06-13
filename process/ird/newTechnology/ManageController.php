<?php

namespace nad\process\ird\newTechnology;

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
                            //'roles' => ['newTechnology.investigation']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor'
                            ],
                            'roles' => ['@']
                            //'roles' => ['newTechnology.investigationMonitor']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-design'
                            ],
                            'roles' => ['@']
                            //'roles' => ['newTechnology.investigationDesign']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/process/ird/newTechnology/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/newTechnology/investigation');
    }

    public function actionInvestigationMonitor()
    {
        return $this->render('@nad/process/ird/newTechnology/investigationMonitor');
    }

    public function actionInvestigationDesign()
    {
        return $this->render('@nad/process/ird/newTechnology/investigationDesign');
    }
}
