<?php

namespace nad\research\modules\resource\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use nad\research\modules\resource\models\Resource;
use nad\research\modules\resource\models\ResourceSearch;

class ManageController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Resource::class;
        $this->searchClass = ResourceSearch::class;
        parent::init();
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionCreate()
    {
        $model = new $this->modelClass;
        if (!empty($this->modelScenario)) {
            $model->scenario = $this->modelScenario;
        }
        $model->loadDefaultValues();
        $model->clientId = (int)Yii::$app->request->get('clientId');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode([
                'status' => 'success',
                'message' => 'داده مورد نظر با موفقیت در سیستم درج شد.'
            ]);
            exit;
        }
        echo Json::encode([
            'content' => $this->renderAjax('_form', ['model' => $model])
        ]);
        exit;
    }
}
