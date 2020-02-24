<?php

namespace nad\factory\production\unit4;

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
                        [
                            'allow' => true,
                            'actions' => [
                                'investigation2'
                            ],
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'investigation3'
                            ],
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'investigation4'
                            ],
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'investigation5'
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
        return $this->render('@nad/factory/production/unit4/index');
    }

    public function actionInvestigation1()
    {
        return $this->render('@nad/factory/production/unit4/investigation1');
    }

    public function actionInvestigation2()
    {
        return $this->render('@nad/factory/production/unit4/investigation2');
    }

    public function actionInvestigation3()
    {
        return $this->render('@nad/factory/production/unit4/investigation3');
    }

    public function actionInvestigation4()
    {
        return $this->render('@nad/factory/production/unit4/investigation4');
    }

    public function actionInvestigation5()
    {
        return $this->render('@nad/factory/production/unit4/investigation5');
    }
}
