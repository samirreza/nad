<?php

namespace nad\process\laboratory\unit3;

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
                            ],
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'investigation1',
                            ],
                            'roles' => ['@']
                        ],
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/process/laboratory/unit3/index');
    }

    public function actionInvestigation1()
    {
        return $this->render('@nad/process/laboratory/unit3/investigation1');
    }
}
