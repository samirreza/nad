<?php

namespace nad\research\control\material\controllers;

use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use core\controllers\AjaxAdminController;
use nad\research\control\material\models\Category;
use nad\research\control\material\models\CategorySearch;

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
                        'application/json' => Response::FORMAT_JSON,
                    ]
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@']
                            //'roles' => ['research.material']
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

        return [$root->getFamilyTreeArrayForWidget()];
    }
}
