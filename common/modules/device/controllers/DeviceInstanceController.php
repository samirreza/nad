<?php

namespace nad\common\modules\device\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\common\modules\device\models\Device;
use nad\common\modules\device\models\DeviceInstance;
use nad\common\modules\device\models\DeviceInstanceDocument;

class DeviceInstanceController extends \core\controllers\AjaxAdminController
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
        $this->modelClass = DeviceInstance::className();
        $this->searchClass = DeviceInstanceSearch::className();
        parent::init();
    }

    public function actionIndex()
    {
        $deviceId = Yii::$app->request->queryParams['DeviceInstanceSearch']['deviceId'];
        $deviceModel = Device::findOne($deviceId);

        $searchModel = new $this->searchClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'deviceModel' => $deviceModel
        ]);
    }
}
