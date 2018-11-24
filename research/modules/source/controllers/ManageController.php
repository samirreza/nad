<?php

namespace nad\research\modules\source\controllers;

use yii\filters\AccessControl;
use nad\research\modules\source\models\Source;
use nad\research\modules\source\models\SourceSearch;
use nad\research\common\controllers\BaseResearchController;

class ManageController extends BaseResearchController
{
    public function init()
    {
        $this->modelClass = Source::class;
        $this->searchClass = SourceSearch::class;
        parent::init();
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['create', 'deliver-to-manager'],
                            'roles' => ['research.createSource']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'documentation'],
                            'roles' => [
                                'expert'
                            ]
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'view',
                                'upate',
                                'delete',
                                'documentation'
                            ],
                            'roles' => [
                                'research.createSource',
                                'research.manageSources'
                            ]
                        ],
                        [
                            'allow' => true,
                            'roles' => ['research.manageSources']
                        ]
                    ]
                ]
            ]
        );
    }
}
