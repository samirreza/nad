<?php

namespace nad\engineering\piping\device\investigationMonitorMethods\method\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\piping\device\investigationMonitorMethods\method\models\Method;
use nad\engineering\piping\device\investigationMonitorMethods\method\models\MethodArchived;
use nad\engineering\piping\device\investigationMonitorMethods\method\models\MethodSearch;
use nad\engineering\piping\device\investigationMonitorMethods\method\models\MethodArchivedSearch;
use nad\common\modules\investigation\method\controllers\MethodController;

class ManageController extends MethodController
{
    public function init()
    {
        $this->archivedClassName = MethodArchived::class;
        $this->archivedSearchClassName = MethodArchivedSearch::class;
        $this->modelClass = Method::class;
        $this->searchClass = MethodSearch::class;
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
                                'certificate',
                                'view-history',
                                'index-history'
                            ],
                            'roles' => ['device.investigationMonitorMethods']
                        ]
                    ]
                ]
            ]
        );
    }
}