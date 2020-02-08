<?php

namespace nad\engineering\mechanics\device;

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
                                'investigation-improvement'
                            ],
                            'roles' => ['device.investigationImprovement']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor-methods'
                            ],
                            'roles' => ['device.investigationMonitorMethods']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-design'
                            ],
                            'roles' => ['device.investigationDesign']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/engineering/mechanics/device/index');
    }

    public function actionInvestigationImprovement()
    {
        return $this->render('@nad/engineering/mechanics/device/investigationImprovement');
    }

    public function actionInvestigationMonitorMethods()
    {
        return $this->render('@nad/engineering/mechanics/device/investigationMonitorMethods');
    }

    public function actionInvestigationDesign()
    {
        return $this->render('@nad/engineering/mechanics/device/investigationDesign');
    }
}
