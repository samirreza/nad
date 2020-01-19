<?php

namespace nad\common\modules\device\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\common\modules\device\models\DevicePart;
use nad\common\modules\device\models\DevicePartDocument;
use nad\common\modules\document\models\DevicePartDocumentSearch;

class DevicePartDocumentController extends \core\controllers\AjaxAdminController
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
                                'update'
                            ],
                            'roles' => ['@']
                        ],
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = DevicePartDocument::className();
        $this->searchClass = DevicePartDocumentSearch::className();
        parent::init();
    }

    public function actionIndex()
    {
        $partId = Yii::$app->request->queryParams['DevicePartDocumentSearch']['partId'];
        $partModel = DevicePart::findOne($partId);

        $searchModel = new $this->searchClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'partModel' => $partModel
        ]);
    }
}
