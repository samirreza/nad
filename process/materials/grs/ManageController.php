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
                            'roles' => ['grs.investigation']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor'
                            ],
                            'roles' => ['grs.investigationMonitor']
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
}
