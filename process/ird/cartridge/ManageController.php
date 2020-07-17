<?php

namespace nad\process\ird\cartridge;

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
                            //'roles' => ['cartridge.investigation']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor'
                            ],
                            'roles' => ['@']
                            //'roles' => ['cartridge.investigationMonitor']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-design'
                            ],
                            'roles' => ['@']
                            //'roles' => ['cartridge.investigationDesign']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'payesh'
                            ],
                            'roles' => ['@']
                            //'roles' => ['cartridge.payesh']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/process/ird/cartridge/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/cartridge/investigation');
    }

    public function actionInvestigationMonitor()
    {
        return $this->render('@nad/process/ird/cartridge/investigationMonitor');
    }

    public function actionInvestigationDesign()
    {
        return $this->render('@nad/process/ird/cartridge/investigationDesign');
    }

    public function actionPayesh()
    {
        return $this->render('@nad/process/ird/cartridge/payesh');
    }
}
