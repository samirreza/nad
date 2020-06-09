<?php

namespace nad\engineering\mechanics\stage\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\mechanics\stage\models\Stage;
use nad\engineering\mechanics\stage\models\StageSearch;
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
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/engineering/mechanics/stage/index');
    }

    public function actionInvestigationImprovement()
    {
        return $this->render('@nad/engineering/mechanics/stage/investigationImprovement');
    }

    public function actionInvestigationMonitorMethods()
    {
        return $this->render('@nad/engineering/mechanics/stage/investigationMonitorMethods');
    }

    public function actionInvestigationDesign()
    {
        return $this->render('@nad/engineering/mechanics/stage/investigationDesign');
    }
}
