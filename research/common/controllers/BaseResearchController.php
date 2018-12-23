<?php

namespace nad\research\common\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use core\controllers\AdminController;
use nad\extensions\documentation\actions\DocumentationAction;
use nad\research\common\models\BaseResearch;

class BaseResearchController extends AdminController
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => ContentNegotiator::class,
                    'only' => [
                        'change-status',
                        'deliver-to-manager',
                        'set-session-date',
                        'write-proceedings'
                    ],
                    'formats' => [
                        'application/json' => Response::FORMAT_JSON
                    ]
                ]
            ]
        );
    }

    public function actions()
    {
        return [
            'documentation' => [
                'class' => DocumentationAction::class,
                'modelClassName' => $this->modelClass
            ]
        ];
    }

    public function actionChangeStatus($id, $newStatus)
    {
        $model = $this->findModel($id)->changeStatus($newStatus);
        echo Json::encode([
            'status' => 'success',
            'message' => 'آیتم ویرایش شده با موفقیت در سیستم به روز رسانی شد.'
        ]);
        exit;
    }

    public function actionDeliverToManager($id)
    {
        $model = $this->findModel($id);
        $model->status = $this->modelClass::STATUS_DELIVERED_TO_MANAGER;
        $model->deliverToManagerDate = time();
        $model->save();
        echo Json::encode([
            'status' => 'success',
            'message' => 'آیتم مورد نظر با موفقیت به مدیر ارسال شد.'
        ]);
        exit;
    }

    public function actionSetSessionDate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = BaseResearch::SCENARIO_SET_SESSION_DATE;
        if ($model->load(Yii::$app->request->post())) {
            $model->status = $this->modelClass::STATUS_WAITING_FOR_MEETING;
            if ($model->save()) {
                echo Json::encode([
                    'status' => 'success',
                    'message' => 'تاریخ جلسه توجیهی با موفقیت در سیستم درج شد.'
                ]);
                exit;
            }
        }
        echo Json::encode([
            'content' => $this->renderAjax('@nad/research/common/views/set-session-date', [
                'model' => $model
            ])
        ]);
        exit;
    }

    public function actionWriteProceedings($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode([
                'status' => 'success',
                'message' => 'نتیجه برگزاری جلسه با موفقیت در سیستم درج شد.'
            ]);
            exit;
        }
        echo Json::encode([
            'content' => $this->renderAjax('@nad/research/common/views/write-proceedings', [
                'model' => $model
            ])
        ]);
        exit;
    }
}
