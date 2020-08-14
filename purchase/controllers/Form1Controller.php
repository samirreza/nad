<?php

namespace nad\purchase\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\purchase\models\Form1;
use nad\purchase\models\Form1Search;
use core\controllers\AdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Form1Controller implements the CRUD actions for Form1 model.
 */
class Form1Controller extends AdminController
{

    public function init()
    {
        $this->modelClass = Form1::class;
        $this->searchClass = Form1Search::class;
    }

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'view',
                                'delete',
                                'create',
                                'update'
                            ],
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!$model->delete()) {
            foreach ($model->getErrors('id') as $error) {
                Yii::$app->session->addFlash('error', $error);
            }
            return $this->redirect(['form1/view', 'id' => $id]);
        } else {
            Yii::$app->session->addFlash(
                'success',
                'داده مورد نظر با موفقیت از سیستم حذف شد.'
            );
        }
        return $this->redirect(['form1/index']);
    }
}
