<?php

namespace modules\nad\maker\backend\controllers;

use yii\filters\AccessControl;
use core\controllers\AdminController;
use modules\nad\maker\backend\models\Maker;
use modules\nad\maker\backend\models\MakerSearch;

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
                            'roles' => ['maker.create']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['maker.update']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['maker.delete']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['index', 'view'],
                            'roles' => [
                                'maker.create',
                                'maker.update',
                                'maker.delete'
                            ]
                        ]
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = Maker::class;
        $this->searchClass = MakerSearch::class;
        parent::init();
    }
}