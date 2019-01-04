<?php

namespace nad\equipment\sample\controllers;

use Yii;
use yii\web\Response;
use yii\filters\AccessControl;
use nad\equipment\sample\models\Sample;
use core\controllers\AjaxAdminController;
use nad\equipment\sample\models\Category;
use nad\equipment\sample\models\SampleSearch;

class ManageController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Sample::class;
        $this->searchClass = SampleSearch::class;
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
