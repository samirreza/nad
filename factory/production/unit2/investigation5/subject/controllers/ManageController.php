<?php

namespace nad\factory\production\unit2\investigation5\subject\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\factory\production\unit2\investigation5\subject\models\Subject;
use nad\factory\production\unit2\investigation5\subject\models\SubjectArchived;
use nad\factory\production\unit2\investigation5\subject\models\SubjectSearch;
use nad\factory\production\unit2\investigation5\subject\models\SubjectArchivedSearch;
use nad\common\modules\investigation\subject\controllers\SubjectController;

class ManageController extends SubjectController
{
    public function init()
    {
        $this->archivedClassName = SubjectArchived::class;
        $this->archivedSearchClassName = SubjectArchivedSearch::class;
        $this->modelClass = Subject::class;
        $this->searchClass = SubjectSearch::class;
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
                            ],
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }
}