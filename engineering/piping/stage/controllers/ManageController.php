<?php

namespace nad\engineering\piping\stage\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\piping\stage\models\Stage;
use nad\engineering\piping\stage\models\StageSearch;
use nad\common\modules\engineering\stage\controllers\ManageController as ParentController;

class ManageController extends ParentController
{
    public function init()
    {
        $this->modelClass = Stage::class;
        $this->searchClass = StageSearch::class;
    }

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
                                'view',
                                'create',
                                'update',
                            ],
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'investigation-improvement',
                            ],
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'investigation-monitor-methods'
                            ],
                            'roles' => ['@']
                            //'roles' => ['stage.investigationMonitorMethods']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'investigation-design'
                            ],
                            'roles' => ['@']
                            //'roles' => ['stage.investigationDesign']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'investigation4'
                            ],
                            'roles' => ['@']
                            //'roles' => ['stage.investigation4']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'payesh'
                            ],
                            'roles' => ['@']
                            //'roles' => ['stage.payesh']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/engineering/piping/stage/index');
    }

    public function actionInvestigationImprovement()
    {
        return $this->render('@nad/engineering/piping/stage/investigationImprovement');
    }

    public function actionInvestigationMonitorMethods()
    {
        return $this->render('@nad/engineering/piping/stage/investigationMonitorMethods');
    }

    public function actionInvestigationDesign()
    {
        return $this->render('@nad/engineering/piping/stage/investigationDesign');
    }

    public function actionInvestigation4()
    {
        return $this->render('@nad/engineering/piping/stage/investigation4');
    }

    public function actionPayesh()
    {
        return $this->render('@nad/engineering/piping/stage/payesh');
    }
}
