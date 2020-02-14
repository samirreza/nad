<?php

namespace nad\build\construction\unit1\investigation1\subject\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\build\construction\unit1\investigation1\subject\models\Subject;
use nad\build\construction\unit1\investigation1\subject\models\SubjectArchived;
use nad\build\construction\unit1\investigation1\subject\models\SubjectSearch;
use nad\build\construction\unit1\investigation1\subject\models\SubjectArchivedSearch;
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