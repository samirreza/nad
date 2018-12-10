<?php

namespace nad\research\lab\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\research\lab\models\Type;
use nad\research\lab\models\Category;
use nad\research\lab\models\TypeSearch;

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
                            'roles' => ['research.manage']
                        ],
                    ],
                ],
            ]
        );
    }

    public function init()
    {
        $this->modelClass = Type::className();
        $this->searchClass = TypeSearch::className();
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
}
