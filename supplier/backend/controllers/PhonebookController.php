<?php

namespace modules\nad\supplier\backend\controllers;

use Yii;
use core\controllers\AdminController;
use modules\nad\supplier\backend\models\Phonebook;
use modules\nad\supplier\backend\models\PhonebookSearch;

class PhonebookController extends AdminController
{
    public function init()
    {
        $this->modelClass = Phonebook::class;
        $this->searchClass = PhonebookSearch::class;
        parent::init();
    }

    public function actionList($supplierId)
    {
        $searchModel = new PhonebookSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'supplierId' => $supplierId,
        ]);
    }

    public function actionCreate()
    {
        $supplierId = Yii::$app->request->get('id');
        $model = new Phonebook();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash(
                'success',
                'شماره تماس با موفقیت در سیستم درج شد.'
            );
            return $this->redirect(['list', 'id' => $supplierId]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'supplierId' => $supplierId
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $supplierId = Yii::$app->request->get('supplierId');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash(
                'success',
                'شماره تماس ویرایش شده با موفقیت در سیستم به روز رسانی شد.'
            );
            return $this->redirect(['list', 'id' => $supplierId]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'supplierId' => $supplierId
            ]);
        }
    }

    public function actionDelete($id)
    {
        $supplierId = Yii::$app->request->get('supplierId');
        $this->findModel($id)->delete();
        Yii::$app->session->addFlash(
            'success',
            'شماره تماس با موفقیت از سیستم حذف شد.'
        );
        return $this->redirect(['list', 'id' => $supplierId]);
    }
}
