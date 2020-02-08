<?php

namespace nad\engineering\geotechnics\location\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\common\modules\engineering\location\models\Category;
use nad\common\modules\engineering\location\models\CategorySearch;
use nad\common\modules\engineering\location\controllers\CategoryController as ParentController;

class CategoryController extends ParentController
{
    public function init()
    {
        $this->modelClass = Category::class;
        $this->searchClass = CategorySearch::class;
    }

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'view',
                                'create',
                                'delete',
                                'get-json-tree',
                                'update'
                            ],
                            // 'roles' => ['nad.engineering.geotechnics.location']
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }
}
