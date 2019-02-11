<?php

namespace nad\research\investigation\common\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use core\controllers\AdminController;
use nad\research\investigation\common\models\BaseInvestigationModel;

class BaseInvestigationController extends AdminController
{
    public function init()
    {
        $this->modelClass = BaseInvestigationModel::class;
        $this->searchClass = false;
        parent::init();
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => ContentNegotiator::class,
                    'only' => [
                        'change-status',
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

    public function actionHome()
    {
        return $this->render('@nad/research/investigation/common/views/home');
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
        Yii::$app->session->addFlash(
            'success',
            'آیتم مورد نظر با موفقیت به مدیر ارسال شد.'
        );
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionSetSessionDate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = BaseInvestigationModel::SCENARIO_SET_SESSION_DATE;
        if ($model->load(Yii::$app->request->post())) {
            $model->status = $this->modelClass::STATUS_WAITING_FOR_MEETING;
            if ($model->save()) {
                Yii::$app->session->addFlash(
                    'success',
                    'تاریخ جلسه توجیهی با موفقیت در سیستم درج شد.'
                );
                return $this->redirect(['view', 'id' => $id]);
            }
        }
        echo Json::encode([
            'content' => $this->renderAjax('@nad/research/investigation/common/views/set-session-date', [
                'model' => $model
            ])
        ]);
        exit;
    }

    public function actionNegotiate($id)
    {
        $model = $this->findModel($id);
        $model->status = $this->modelClass::STATUS_NEGOTIATE_MADE;
        $model->negotiateDate = time();
        $model->save();
        Yii::$app->session->addFlash(
            'success',
            'تاریخ برگزاری مذاکره با موفقیت در سیستم درج شد.'
        );
        return $this->redirect(['view', 'id' => $id]);
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
            'content' => $this->renderAjax('@nad/research/investigation/common/views/write-proceedings', [
                'model' => $model
            ])
        ]);
        exit;
    }

    public function actionReport()
    {
        $searchModel = new $this->searchClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}
