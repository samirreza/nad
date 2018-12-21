<?php

namespace nad\engineering\plant\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\engineering\plant\models\Plant;
use nad\engineering\plant\models\Category;
use nad\engineering\plant\models\PlantSearch;

class ManageController extends \core\controllers\AjaxAdminController
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
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

    public function init()
    {
        $this->modelClass = Plant::className();
        $this->searchClass = PlantSearch::className();
        parent::init();
    }

    public function actionTreeList()
    {
        return $this->render('tree');
    }

    public function actionGetJsonTree($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
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
