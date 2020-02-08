<?php

namespace nad\engineering\geotechnics\device\investigationMonitorMethods\source\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\geotechnics\device\investigationMonitorMethods\source\models\Source;
use nad\engineering\geotechnics\device\investigationMonitorMethods\source\models\SourceArchived;
use nad\engineering\geotechnics\device\investigationMonitorMethods\source\models\SourceSearch;
use nad\engineering\geotechnics\device\investigationMonitorMethods\source\models\SourceArchivedSearch;
use nad\common\modules\investigation\source\controllers\SourceController;

class ManageController extends SourceController
{
    public function init()
    {
        $this->archivedClassName = SourceArchived::class;
        $this->archivedSearchClassName = SourceArchivedSearch::class;
        $this->modelClass = Source::class;
        $this->searchClass = SourceSearch::class;
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
