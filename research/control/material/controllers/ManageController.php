<?php

namespace nad\research\control\material\controllers;

use Yii;
use yii\web\Response;
use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use nad\research\control\material\models\Type;
use nad\research\control\material\models\Category;
use nad\research\control\material\models\TypeSearch;

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
                            'roles' => ['@']
                            //'roles' => ['research.material']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionAjaxFindMaterials($q = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $types = Type::find()
            ->select(['id', 'title', 'uniqueCode'])
            ->where(['or', ['like', 'title', $q], ['like', 'uniqueCode', $q]])
            ->all();
        $materials['results'] = [];
        foreach ($types as $type) {
            $materials['results'][] = [
                'id' => $type->title,
                'text' => $type->uniqueCode . ' (' . $type->title . ') ',
            ];
        }

        return $materials;
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
}
