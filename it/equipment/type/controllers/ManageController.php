<?php

namespace nad\it\equipment\type\controllers;

use Yii;
use yii\web\Response;
use yii\filters\AccessControl;
use nad\it\equipment\type\models\Type;
use core\controllers\AjaxAdminController;
use nad\it\equipment\type\models\Category;
use nad\it\equipment\type\models\TypeSearch;

class ManageController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Type::class;
        $this->searchClass = TypeSearch::class;
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
                            'actions' => [
                                'index',
                                'view',
                                'create',
                                'update',
                                'delete',
                                'tree-list',
                                'get-json-tree'
                            ],
                            'roles' => ['it.equipment-type']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['report', 'get-json-tree'],
                            'roles' => ['manager']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionTreeList()
    {
        return $this->render('tree');
    }

    public function actionGetJsonTree($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $roots = Category::find()->roots()->all();
        $tree = [];
        foreach ($roots as $root) {
            $tree[] = $root->getFamilyTreeArrayForWidget();
        }
        return $tree;
    }

    public function actionReport()
    {
        return $this->render('report');
    }
}
