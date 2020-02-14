<?php

namespace nad\factory\build\unit1\investigation3\method\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\factory\build\unit1\investigation3\method\models\Method;
use nad\factory\build\unit1\investigation3\method\models\MethodArchived;
use nad\factory\build\unit1\investigation3\method\models\MethodSearch;
use nad\factory\build\unit1\investigation3\method\models\MethodArchivedSearch;
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
                        ]
                    ]
                ]
            ]
        );
    }
}