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
                                'start',
                                'investigation'
                            ],
                            'roles' => ['engineering.piping.stage']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionStart()
    {
        return $this->render('@nad/engineering/piping/stage/start');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/engineering/piping/stage/investigation');
    }
}
