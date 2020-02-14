<?php

namespace nad\build\equipment\unit1\investigation2\subject\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\build\equipment\unit1\investigation2\subject\models\Subject;
use nad\build\equipment\unit1\investigation2\subject\models\SubjectArchived;
use nad\build\equipment\unit1\investigation2\subject\models\SubjectSearch;
use nad\build\equipment\unit1\investigation2\subject\models\SubjectArchivedSearch;
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