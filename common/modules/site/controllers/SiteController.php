<?php

namespace nad\common\modules\site\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\common\modules\site\models\Site;
use nad\common\modules\site\models\Document;
use nad\common\modules\site\models\SiteSearch;
use nad\common\modules\engineering\stage\models\Category as StageCategory;

class SiteController extends \core\controllers\AjaxAdminController
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
                                'get-stage-title-and-code'
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
        $this->modelClass = Site::className();
        $this->searchClass = SiteSearch::className();
        parent::init();
    }

    public function actionTreeList()
    {
        return $this->render('tree');
    }


    public function actionGetJsonTree($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $roots = StageCategory::find()->roots()->all();
        $tree = [];
        $reversedRoots = array_reverse($roots); // don't know why?!
        foreach ($reversedRoots as $root) {
            $tree[] = $root->getFamilyTreeArrayForWidget();
        }
        return $tree;
    }

    public function actionIndex()
    {
        $searchModel = new $this->searchClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGetStageTitleAndCode($stageId){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $stageCategory = StageCategory::findOne(['id' => $stageId]);

        if(isset($stageCategory)){
            return [
                'familyTreeTitle' => $stageCategory->familyTreeTitle,
                'code' => $stageCategory->code
            ];
        }else{
            return 'نام مرحله مشخص نیست!';
        }
    }
}
