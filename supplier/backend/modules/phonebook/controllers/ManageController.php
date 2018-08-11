<?php

namespace modules\nad\supplier\backend\modules\phonebook\controllers;

use Yii;
use yii\helpers\Json;
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
                            'actions' => ['list', 'create', 'update', 'delete'],
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
            echo Json::encode(
                [
                    'status' => 'success',
                    'message' => 'شماره تماس با موفقیت در سیستم درج شد.'
                ]
            );
            exit;
        }
        echo Json::encode(
            [
                'content' => $this->renderAjax('_form', ['model' => $model, 'supplierId' => $supplierId])
            ]
        );
        exit;
    }

    public function actionUpdate($id)
    {
        $supplierId = Yii::$app->request->get('supplierId');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode(
                [
                    'status' => 'success',
                    'message' => 'شماره تماس ویرایش شده با موفقیت در سیستم به روز رسانی شد.'
                ]
            );
            exit;
        }
        echo Json::encode(
            [
                'content' => $this->renderAjax('_form', ['model' => $model, 'supplierId' => $supplierId])
            ]
        );
        exit;
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        echo Json::encode(
            [
                'status' => 'success',
                'message' => 'شماره تماس با موفقیت از سیستم حذف شد.'
            ]
        );
        exit;
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
