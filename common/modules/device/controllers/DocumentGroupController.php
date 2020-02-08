<?php

namespace nad\common\modules\device\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\common\modules\device\models\Device;
use nad\common\modules\device\models\DeviceSearch;

class DocumentGroupController extends \core\controllers\AjaxAdminController
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
                            ],
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['manager']
                        ]
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = Device::className();
        $this->searchClass = DeviceSearch::className();
        parent::init();
    }

    public function actionIndex()
    {
        $deviceId = Yii::$app->request->queryParams['DocumentGroupSearch']['deviceId'];
        $deviceModel = Device::findOne($deviceId);
        $searchModel = new $this->searchClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'deviceModel' => $deviceModel
        ]);
    }

    // public function getViewPath()
    // {
    //     return Yii::getAlias('@nad/common/modules/engineering/device/views/manage');
    // }
}
