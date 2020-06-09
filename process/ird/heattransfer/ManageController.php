<?php

namespace nad\process\ird\heattransfer;

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
                            //'roles' => ['heattransfer.investigation']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor'
                            ],
                            'roles' => ['@']
                            //'roles' => ['heattransfer.investigationMonitor']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-design'
                            ],
                            'roles' => ['@']
                            //'roles' => ['heattransfer.investigationDesign']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/process/ird/heattransfer/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/heattransfer/investigation');
    }

    public function actionInvestigationMonitor()
    {
        return $this->render('@nad/process/ird/heattransfer/investigationMonitor');
    }

    public function actionInvestigationDesign()
    {
        return $this->render('@nad/process/ird/heattransfer/investigationDesign');
    }
}
