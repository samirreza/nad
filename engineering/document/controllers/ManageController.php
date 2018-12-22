<?php

namespace nad\engineering\document\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\engineering\document\models\Document;
use nad\engineering\document\models\Category;
use nad\engineering\document\models\DocumentSearch;

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
        $this->modelClass = Document::className();
        $this->searchClass = DocumentSearch::className();
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
