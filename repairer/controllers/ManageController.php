<?php

namespace modules\nad\repairer\controllers;

use yii\filters\AccessControl;
use core\controllers\AdminController;
use modules\nad\repairer\models\Repairer;
use modules\nad\repairer\models\RepairerSearch;

class ManageController extends AdminController
{
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
                            'actions' => ['create'],
                            'roles' => ['repairer.create']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['repairer.update']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['repairer.delete']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'phonebook'],
                            'roles' => [
                                'repairer.create',
                                'repairer.update',
                                'repairer.delete'
                            ]
                        ]
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = Repairer::class;
        $this->searchClass = RepairerSearch::class;
        parent::init();
    }
}