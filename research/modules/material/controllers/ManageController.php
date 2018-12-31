<?php

namespace nad\research\modules\material\controllers;

use Yii;
use yii\web\Response;
use yii\filters\AccessControl;
use nad\research\modules\material\models\Type;
use nad\research\modules\material\models\Category;
use nad\research\modules\material\models\TypeSearch;

class ManageController extends \core\controllers\AjaxAdminController
{
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
                            'roles' => ['research.material']
                        ]
                    ]
                ]
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
            $tree[] = $root->getFamilyTreeArray();
        }
        return $tree;
    }
}
