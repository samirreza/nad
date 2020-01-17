<?php

namespace nad\common\modules\device\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\common\modules\device\models\PartInstance;
use nad\common\modules\device\models\DevicePartInstanceDocument;
use nad\common\modules\document\models\DevicePartInstanceDocumentSearch;

class DevicePartInstanceDocumentController extends \core\controllers\AjaxAdminController
{

    public function init()
    {
        $this->modelClass = DevicePartInstanceDocument::className();
        $this->searchClass = DevicePartInstanceDocumentSearch::className();
        parent::init();
    }

    public function actionIndex()
    {
        $instanceId = Yii::$app->request->queryParams['DevicePartInstanceDocumentSearch']['instanceId'];
        $instanceModel = PartInstance::findOne($instanceId);

        $searchModel = new $this->searchClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'instanceModel' => $instanceModel
        ]);
    }
}
