<?php

namespace nad\common\modules\device\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\common\modules\device\models\Device;
use nad\common\modules\device\models\DeviceDocument;
use nad\common\modules\document\models\DeviceDocumentSearch;

class DeviceDocumentController extends \core\controllers\AjaxAdminController
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
        $this->modelClass = DeviceDocument::className();
        $this->searchClass = DeviceDocumentSearch::className();
        parent::init();
    }

    public function actionIndex()
    {
        $searchModel = new $this->searchClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}
