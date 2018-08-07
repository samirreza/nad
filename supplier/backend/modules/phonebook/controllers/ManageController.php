<?php

namespace modules\nad\supplier\backend\modules\phonebook\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use modules\nad\supplier\backend\models\Supplier;
use modules\nad\supplier\backend\modules\phonebook\models\Phonebook;
use modules\nad\supplier\backend\modules\phonebook\models\PhonebookSearch;

class ManageController extends Controller
{
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
                            'actions' => ['list','create','update','delete'],
                            'roles' => [
                                'supplier.create',
                                'supplier.update',
                                'supplier.delete'
                            ]
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionList($supplierId)
    {
        $searchModel = new PhonebookSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $supplier = Supplier::findOne($supplierId);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'supplierId' => $supplierId,
            'supplier' => $supplier,
        ]);
    }

    public function actionCreate()
    {
        $supplierId = Yii::$app->request->get('supplierId');
        $model = new Phonebook();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash(
                'success',
                'شماره تماس با موفقیت در سیستم درج شد.'
            );
            return $this->redirect(['list', 'supplierId' => $supplierId]);
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
            return $this->redirect(['list', 'supplierId' => $supplierId]);
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
        return $this->redirect(['list', 'supplierId' => $supplierId]);
    }

    protected function findModel($id)
    {
        $modelClass = Phonebook::class;
        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
