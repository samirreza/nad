<?php

namespace nad\office\modules\expert\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use nad\office\modules\expert\models\Expert;
use nad\office\modules\expert\models\ExpertSearch;
use nad\office\modules\expert\models\ExpertForm;

class ManageController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Expert::class;
        $this->searchClass = ExpertSearch::class;
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
                            'roles' => ['office.manageExpert']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionCreate()
    {
        $expertForm = new ExpertForm(new Expert());
        if ($expertForm->load(Yii::$app->request->post()) && $expertForm->save()) {
            echo Json::encode([
                'status' => 'success',
                'message' => 'کارشناس با موفقیت در سیستم درج شد'
            ]);
            exit;
        }
        echo Json::encode([
            'content' => $this->renderAjax('_form', ['expertForm' => $expertForm])
        ]);
        exit;
    }

    public function actionUpdate($id)
    {
        $expertForm = new ExpertForm($this->findModel($id));
        $expertForm->user->scenario = 'update';
        if ($expertForm->load(Yii::$app->request->post()) && $expertForm->save()) {
            echo Json::encode([
                'status' => 'success',
                'message' => 'کارشناس ویرایش شده با موفقیت در سیستم به روز رسانی شد.'
            ]);
            exit;
        }
        echo Json::encode([
            'content' => $this->renderAjax('_form', ['expertForm' => $expertForm])
        ]);
        exit;
    }
}
