<?php

namespace nad\research\extensions\resource\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use nad\research\extensions\resource\models\Resource;
use nad\research\extensions\resource\models\ResourceSearch;

class BaseResourceController extends AjaxAdminController
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

    public function actionView($id)
    {
        echo Json::encode([
            'content' => $this->renderAjax('@nad/research/extensions/resource/views/view', [
                'model' => $this->findModel($id)
            ])
        ]);
        exit;
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
            'content' => $this->renderAjax('@nad/research/extensions/resource/views/_form', [
                'model' => $model
            ])
        ]);
        exit;
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (!empty($this->modelScenario)) {
            $model->scenario = $this->modelScenario;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode([
                'status' => 'success',
                'message' => 'آیتم ویرایش شده با موفقیت در سیستم به روز رسانی شد.'
            ]);
            exit;
        }
        echo Json::encode([
            'content' => $this->renderAjax('@nad/research/extensions/resource/views/_form', [
                'model' => $model
            ])
        ]);
        exit;
    }
}
