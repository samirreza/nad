<?php

namespace nad\factory\build\unit2\investigation1\report\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\factory\build\unit2\investigation1\report\models\Report;
use nad\factory\build\unit2\investigation1\report\models\ReportArchived;
use nad\factory\build\unit2\investigation1\report\models\ReportSearch;
use nad\factory\build\unit2\investigation1\report\models\ReportArchivedSearch;
use nad\common\modules\investigation\report\controllers\ReportController;

class ManageController extends ReportController
{
    public function init()
    {
        $this->archivedClassName = ReportArchived::class;
        $this->archivedSearchClassName = ReportArchivedSearch::class;
        $this->modelClass = Report::class;
        $this->searchClass = ReportSearch::class;
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