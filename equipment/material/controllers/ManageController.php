<?php

namespace nad\equipment\material\controllers;

use Yii;
use yii\web\Response;
use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use nad\equipment\material\models\Category;
use nad\equipment\material\models\Material;
use nad\equipment\material\models\MaterialSearch;

class ManageController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Material::class;
        $this->searchClass = MaterialSearch::class;
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
}
