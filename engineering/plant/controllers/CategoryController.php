<?php
namespace nad\engineering\plant\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use nad\engineering\plant\models\Category;
use nad\engineering\plant\models\CategorySearch;

class CategoryController extends \core\controllers\AjaxAdminController
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => \yii\filters\ContentNegotiator::className(),
                    'only' => ['get-json-tree'],
                    'formats' => [
                        'application/json' => \yii\web\Response::FORMAT_JSON,
                    ]
                ],
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function init()
    {
        $this->modelClass = Category::className();
        $this->searchClass = CategorySearch::className();
        parent::init();
    }

    public function actions()
    {
        return [
            'create' => [
                'class' => 'core\tree\actions\CreateAction',
                'modelClass' => Category::className(),
                'isAjax' => true
            ],
            'update' => [
                'class' => 'core\tree\actions\UpdateAction',
                'modelClass' => Category::className(),
                'isAjax' => true
            ],
            'delete' => [
                'class' => 'core\tree\actions\DeleteAction',
                'modelClass' => Category::className(),
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
        return $root ? [$root->getFamilyTreeArray()] : [];
    }
}
