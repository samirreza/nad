<?php

namespace nad\process\ird\graphene;

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
                            //'roles' => ['graphene.investigation']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-monitor'
                            ],
                            'roles' => ['@']
                            //'roles' => ['graphene.investigationMonitor']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'investigation-design'
                            ],
                            'roles' => ['@']
                            //'roles' => ['graphene.investigationDesign']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/process/ird/graphene/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/graphene/investigation');
    }

    public function actionInvestigationMonitor()
    {
        return $this->render('@nad/process/ird/graphene/investigationMonitor');
    }

    public function actionInvestigationDesign()
    {
        return $this->render('@nad/process/ird/graphene/investigationDesign');
    }
}
