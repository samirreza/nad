<?php

namespace nad\build\well\unit3\investigation5\source\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\build\well\unit3\investigation5\source\models\Source;
use nad\build\well\unit3\investigation5\source\models\SourceArchived;
use nad\build\well\unit3\investigation5\source\models\SourceSearch;
use nad\build\well\unit3\investigation5\source\models\SourceArchivedSearch;
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
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }
}
