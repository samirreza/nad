<?php

namespace nad\common\modules\device\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\common\modules\device\models\Device;
use nad\common\modules\device\models\DevicePart;
use nad\common\modules\device\models\DevicePartDocument;
use nad\common\modules\device\models\DevicePartSearch;

class DevicePartController extends \core\controllers\AjaxAdminController
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
                        ],
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = DevicePart::className();
        $this->searchClass = DevicePartDocument::className();
        parent::init();
    }

    public function actionIndex()
    {
        $deviceId = Yii::$app->request->queryParams['DevicePartSearch']['deviceId'];
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
