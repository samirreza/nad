<?php

namespace nad\engineering\equipment\modules\type\controllers;

use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use core\controllers\AjaxAdminController;
use nad\engineering\equipment\modules\type\models\Category;
use nad\engineering\equipment\modules\type\models\CategorySearch;

class CategoryController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Category::class;
        $this->searchClass = CategorySearch::class;
        parent::init();
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => ContentNegotiator::class,
                    'only' => ['get-json-tree'],
                    'formats' => [
                        'application/json' => Response::FORMAT_JSON
                    ]
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'view',
                                'create',
                                'delete',
                                'get-json-tree'
                            ],
                            'roles' => ['equipment.type']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['manager']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actions()
    {
        return [
            'create' => [
                'class' => 'core\tree\actions\CreateAction',
                'modelClass' => Category::class,
                'isAjax' => true
            ],
            'update' => [
                'class' => 'core\tree\actions\UpdateAction',
                'modelClass' => Category::class,
                'isAjax' => true
            ],
            'delete' => [
                'class' => 'core\tree\actions\DeleteAction',
                'modelClass' => Category::class,
                'isAjax' => true
            ]
        ];
    }

    public function actionGetJsonTree($id)
    {
        if ($id == '0') {
            $root = Category::find()->roots()->one();
        } else {
            $root = $this->findModel($id);
        }

        return $root ? [$root->getFamilyTreeArrayForWidget()] : [];
    }
}
