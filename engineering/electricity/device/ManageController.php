<?php

namespace nad\engineering\electricity\device;

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
                            // 'roles' => ['@']
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor-methods'
                            ],
                            // 'roles' => ['device.investigationMonitorMethods']
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-design'
                            ],
                            // 'roles' => ['device.investigationDesign']
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/engineering/electricity/device/index');
    }

    public function actionInvestigationImprovement()
    {
        return $this->render('@nad/engineering/electricity/device/investigationImprovement');
    }

    public function actionInvestigationMonitorMethods()
    {
        return $this->render('@nad/engineering/electricity/device/investigationMonitorMethods');
    }

    public function actionInvestigationDesign()
    {
        return $this->render('@nad/engineering/electricity/device/investigationDesign');
    }
}
