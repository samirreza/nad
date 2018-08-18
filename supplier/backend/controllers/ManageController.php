<?php

namespace modules\nad\supplier\backend\controllers;

use yii\filters\AccessControl;
use core\controllers\AdminController;
use modules\nad\supplier\backend\models\Supplier;
use modules\nad\supplier\backend\models\SupplierSearch;

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
                            'roles' => ['supplier.create']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['supplier.update']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['supplier.delete']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'phonebook'],
                            'roles' => [
                                'supplier.create',
                                'supplier.update',
                                'supplier.delete'
                            ]
                        ]
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = Supplier::class;
        $this->searchClass = SupplierSearch::class;
        parent::init();
    }
}