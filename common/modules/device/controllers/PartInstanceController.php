<?php

namespace nad\common\modules\device\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\common\modules\device\models\PartInstance;
use nad\common\modules\device\models\PartInstanceSearch;
use nad\common\modules\device\models\PartInstanceDocument;

class PartInstanceController extends \core\controllers\AjaxAdminController
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
                                'update'
                            ],
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = PartInstance::className();
        $this->searchClass = PartInstanceSearch::className();
        parent::init();
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
}
