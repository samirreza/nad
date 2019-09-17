<?php

namespace nad\common\modules\engineering\document\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\common\modules\engineering\document\models\Document;
use nad\common\modules\engineering\location\models\Location;
use nad\common\modules\engineering\document\models\DocumentSearch;

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

    public function actionReport()
    {
        return $this->render('report');
    }

    public function actionIndex()
    {
        $groupId = Yii::$app->request->queryParams['DocumentSearch']['groupId'];  
        $locationModel = Location::findOne($groupId);        
        $searchModel = new $this->searchClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'locationModel' => $locationModel
        ]);
    }

    // public function getViewPath()
    // {
    //     return Yii::getAlias('@nad/common/modules/engineering/document/views/manage');
    // }
}
