<?php

namespace nad\common\modules\engineering\location\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\common\modules\engineering\location\models\Location;
use nad\common\modules\engineering\stage\models\Category;
use nad\common\modules\engineering\location\models\LocationSearch;

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
                            'actions' => [
                                'index',
                                'view',
                                'create',
                                'delete',
                                'tree-list',
                                'get-json-tree',
                                'report'
                            ],
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update', 'report'],
                            'roles' => ['manager']
                        ]
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = Location::className();
        $this->searchClass = LocationSearch::className();
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
            $tree[] = $root->getFamilyTreeArrayForWidget();
        }
        return $tree;
    }

    public function actionReport()
    {
        return $this->render('report');
    }

    public function actionIndex()
    {
        $categoryId = Yii::$app->request->queryParams['LocationSearch']['categoryId'];  
        $categoryModel = Category::findOne($categoryId);        
        $searchModel = new $this->searchClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categoryModel' => $categoryModel
        ]);
    }

    // public function getViewPath()
    // {
    //     return Yii::getAlias('@nad/common/modules/engineering/location/views/manage');
    // }
}
