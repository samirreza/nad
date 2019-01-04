<?php

namespace nad\equipment\model\controllers;

use Yii;
use yii\web\Response;
use yii\filters\AccessControl;
use nad\equipment\model\models\Model;
use nad\equipment\model\models\Category;
use core\controllers\AjaxAdminController;
use nad\equipment\model\models\ModelSearch;

class ManageController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Model::class;
        $this->searchClass = ModelSearch::class;
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
                            'roles' => ['@']
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
            $tree[] = $root->getFamilyTreeArray();
        }

        return $tree;
    }

    public function actionReport()
    {
        return $this->render('report');
    }
}
