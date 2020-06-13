<?php

namespace nad\rla\controllers;

use Yii;
use yii\filters\AccessControl;
use core\controllers\AdminController;
use nad\rla\models\RowLevelAccessRequest;
use nad\rla\models\RowLevelAccessRequestSearch;

class RequestController extends AdminController
{
    public function behaviors()
    {
        return array_merge(
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
                            ],
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'update',
                                'delete',
                            ],
                            'roles' => ['superuser']
                        ]
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = RowLevelAccessRequest::class;
        $this->searchClass = RowLevelAccessRequestSearch::class;
        parent::init();
    }

    public function actionView($id){
        return $this->redirect('index');
    }
}
