<?php

namespace nad\process\materials\antimicrobial\investigationMonitor\report\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\materials\antimicrobial\investigationMonitor\report\models\Report;
use nad\process\materials\antimicrobial\investigationMonitor\report\models\ReportSearch;
use nad\common\modules\investigation\report\controllers\ReportController;

class ManageController extends ReportController
{
    public function init()
    {
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
                                'create'
                            ],
                            'roles' => ['antimicrobial.investigationMonitor']
                        ]
                    ]
                ]
            ]
        );
    }
}