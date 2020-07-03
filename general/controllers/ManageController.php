<?php

namespace nad\general\controllers;

use Yii;

use yii\filters\AccessControl;
use yii\web\Controller;

class ManageController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'manager-actions'
                        ],
                        'roles' => ['superuser']
                    ],
                ]
            ]
        ];
    }

    public function actionManagerActions(){
        return $this->render('manager-actions');
    }
}