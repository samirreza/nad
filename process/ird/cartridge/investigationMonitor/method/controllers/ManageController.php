<?php

namespace nad\process\ird\cartridge\investigationMonitor\method\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\ird\cartridge\investigationMonitor\method\models\Method;
use nad\process\ird\cartridge\investigationMonitor\method\models\MethodArchived;
use nad\process\ird\cartridge\investigationMonitor\method\models\MethodSearch;
use nad\process\ird\cartridge\investigationMonitor\method\models\MethodArchivedSearch;
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
                            'roles' => ['@']
                            //'roles' => ['cartridge.investigation']
                        ]
                    ]
                ]
            ]
        );
    }
}