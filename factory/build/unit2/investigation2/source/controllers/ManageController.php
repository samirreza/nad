<?php

namespace nad\factory\build\unit2\investigation2\source\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\factory\build\unit2\investigation2\source\models\Source;
use nad\factory\build\unit2\investigation2\source\models\SourceArchived;
use nad\factory\build\unit2\investigation2\source\models\SourceSearch;
use nad\factory\build\unit2\investigation2\source\models\SourceArchivedSearch;
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
