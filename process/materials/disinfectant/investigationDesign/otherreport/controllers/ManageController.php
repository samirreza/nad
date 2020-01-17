<?php

namespace nad\process\materials\disinfectant\investigationDesign\otherreport\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\materials\disinfectant\investigationDesign\otherreport\models\Otherreport;
use nad\process\materials\disinfectant\investigationDesign\otherreport\models\OtherreportArchived;
use nad\process\materials\disinfectant\investigationDesign\otherreport\models\OtherreportSearch;
use nad\process\materials\disinfectant\investigationDesign\otherreport\models\OtherreportArchivedSearch;
use nad\common\modules\investigation\otherreport\controllers\OtherreportController;

class ManageController extends OtherreportController
{
    public function init()
    {
        $this->archivedClassName = OtherreportArchived::class;
        $this->archivedSearchClassName = OtherreportArchivedSearch::class;
        $this->modelClass = Otherreport::class;
        $this->searchClass = OtherreportSearch::class;
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
                            'roles' => ['disinfectant.investigationDesign']
                        ]
                    ]
                ]
            ]
        );
    }
}