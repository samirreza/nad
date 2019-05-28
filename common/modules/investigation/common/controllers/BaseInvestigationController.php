<?php

namespace nad\common\modules\investigation\common\controllers;

use Yii;
use yii\helpers\Json;
use core\controllers\AdminController;
use nad\common\modules\investigation\common\models\BaseInvestigationModel;

class BaseInvestigationController extends AdminController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['superuser']
                    ]
                ]
            ]
        ];
    }

    public function actionDeliverToManager($id)
    {
        $model = static::findModel($id);
        $model->status = BaseInvestigationModel::STATUS_IN_MANAGER_HAND;
        $model->deliverToManagerDate = time();
        $model->save();
        Yii::$app->session->addFlash(
            'success',
            'آیتم مورد نظر با موفقیت به مدیر ارسال شد.'
        );
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionChangeStatus($id, $newStatus)
    {
        static::findModel($id)->changeStatus($newStatus);
        Yii::$app->session->addFlash(
            'success',
            'آیتم ویرایش شده با موفقیت در سیستم به روز رسانی شد.'
        );
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionSetSessionDate($id)
    {
        $model = static::findModel($id);
        $model->scenario = BaseInvestigationModel::SCENARIO_SET_SESSION_DATE;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->addFlash(
                    'success',
                    'تاریخ جلسه توجیهی با موفقیت در سیستم درج شد.'
                );
                return $this->redirect(['view', 'id' => $id]);
            }
        }
        echo Json::encode([
            'content' => $this->renderAjax('@nad/common/modules/investigation/common/views/set-session-date', [
                'model' => $model
            ])
        ]);
        exit;
    }

    public function actionWriteProceedings($id)
    {
        $model = static::findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode([
                'status' => 'success',
                'message' => 'نتیجه برگزاری جلسه با موفقیت در سیستم درج شد.'
            ]);
            exit;
        }
        echo Json::encode([
            'content' => $this->renderAjax('@nad/common/modules/investigation/common/views/write-proceedings', [
                'model' => $model
            ])
        ]);
        exit;
    }

    public function actionWriteNegotiationResult($id)
    {
        $model = static::findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode([
                'status' => 'success',
                'message' => 'نتیجه مذاکره جلسه با موفقیت در سیستم درج شد.'
            ]);
            exit;
        }
        echo Json::encode([
            'content' => $this->renderAjax('@nad/common/modules/investigation/common/views/write-negotiation-result', [
                'model' => $model
            ])
        ]);
        exit;
    }
}
