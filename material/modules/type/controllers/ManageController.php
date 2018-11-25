<?php

namespace modules\nad\material\modules\type\controllers;

use Yii;
use yii\filters\AccessControl;
use modules\nad\material\modules\type\models\Type;
use modules\nad\material\modules\type\models\Category;
use modules\nad\material\modules\type\models\TypeSearch;

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
                            'roles' => ['material.type']
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

    public function actionAjaxFindMaterials($q = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

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
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $roots = Category::find()->roots()->all();
        $tree = [];
        foreach ($roots as $root) {
            $tree[] = $root->getFamilyTreeArray();
        }
        return $tree;
    }

}
