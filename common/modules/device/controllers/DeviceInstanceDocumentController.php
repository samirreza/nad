<?php

namespace nad\common\modules\device\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\common\modules\device\models\DeviceInstance;
use nad\common\modules\device\models\DeviceInstanceDocument;
use nad\common\modules\document\models\DeviceInstanceDocumentSearch;

class DeviceInstanceDocumentController extends \core\controllers\AjaxAdminController
{

    public function init()
    {
        $this->modelClass = DeviceInstanceDocument::className();
        $this->searchClass = DeviceInstanceDocumentSearch::className();
        parent::init();
    }

    public function actionIndex()
    {
        $instanceId = Yii::$app->request->queryParams['DeviceInstanceDocumentSearch']['instanceId'];
        $instanceModel = DeviceInstance::findOne($instanceId);

        $searchModel = new $this->searchClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'instanceModel' => $instanceModel
        ]);
    }
}
