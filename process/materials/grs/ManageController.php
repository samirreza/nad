<?php

namespace nad\process\materials\grs;

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
                            //'roles' => ['grs.investigation']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor'
                            ],
                            'roles' => ['@']
                            //'roles' => ['grs.investigationMonitor']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-design'
                            ],
                            'roles' => ['@']
                            //'roles' => ['grs.investigationDesign']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/process/materials/grs/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/materials/grs/investigation');
    }

    public function actionInvestigationMonitor()
    {
        return $this->render('@nad/process/materials/grs/investigationMonitor');
    }

    public function actionInvestigationDesign()
    {
        return $this->render('@nad/process/materials/grs/investigationDesign');
    }
}
