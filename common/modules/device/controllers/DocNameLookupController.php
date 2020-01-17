<?php

namespace nad\common\modules\device\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\common\modules\device\models\DocNameLookup;

class DocNameLookupController extends \core\controllers\AjaxAdminController
{

    public function init()
    {
        $this->modelClass = Device::className();
        $this->searchClass = DeviceSearch::className();
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
