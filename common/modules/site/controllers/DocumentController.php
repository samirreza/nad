<?php

namespace nad\common\modules\site\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\common\modules\site\models\Site;
use nad\common\modules\site\models\Document;
use nad\common\modules\document\models\DocumentSearch;

class DocumentController extends \core\controllers\AjaxAdminController
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
                            ],
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
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

    public function actionIndex()
    {
        $siteId = Yii::$app->request->queryParams['DocumentSearch']['siteId'];
        $siteModel = Site::findOne($siteId);
        $searchModel = new $this->searchClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'siteModel' => $siteModel
        ]);
    }
}
