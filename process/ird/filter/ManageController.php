<?php

namespace nad\process\ird\filter;

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
                            'roles' => ['filter.investigation']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',                                
                                'investigation-monitor'
                            ],
                            'roles' => ['filter.investigationMonitor']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-design'
                            ],
                            'roles' => ['filter.investigationDesign']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/process/ird/filter/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/filter/investigation');
    }

    public function actionInvestigationMonitor()
    {
        return $this->render('@nad/process/ird/filter/investigationMonitor');
    }

    public function actionInvestigationDesign()
    {
        return $this->render('@nad/process/ird/filter/investigationDesign');
    }
}
