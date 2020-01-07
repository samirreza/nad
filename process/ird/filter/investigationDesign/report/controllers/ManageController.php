<?php

namespace nad\process\ird\filter\investigationDesign\report\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\ird\filter\investigationDesign\report\models\Report;
use nad\process\ird\filter\investigationDesign\report\models\ReportArchived;
use nad\process\ird\filter\investigationDesign\report\models\ReportSearch;
use nad\process\ird\filter\investigationDesign\report\models\ReportArchivedSearch;
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
                            'roles' => ['filter.investigationDesign']
                        ]
                    ]
                ]
            ]
        );
    }
}