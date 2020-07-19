<?php

namespace nad\coordination;

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
                                'index'
                            ],
                            'roles' => ['@']
                            //'roles' => ['coordination.index']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'payesh'
                            ],
                            'roles' => ['@']
                            //'roles' => ['coordination.payesh']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionIndex()
    {
        return $this->render('@nad/coordination/index');
    }

    public function actionPayesh()
    {
        return $this->render('@nad/coordination/payesh');
    }
}
