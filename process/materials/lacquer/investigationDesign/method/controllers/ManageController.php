<?php

namespace nad\process\materials\lacquer\investigationDesign\method\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\materials\lacquer\investigationDesign\method\models\Method;
use nad\process\materials\lacquer\investigationDesign\method\models\MethodArchived;
use nad\process\materials\lacquer\investigationDesign\method\models\MethodSearch;
use nad\process\materials\lacquer\investigationDesign\method\models\MethodArchivedSearch;
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
                            //'roles' => ['lacquer.investigationDesign']
                        ]
                    ]
                ]
            ]
        );
    }
}