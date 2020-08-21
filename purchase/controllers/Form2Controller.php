<?php

namespace nad\purchase\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\purchase\models\Form2;
use nad\purchase\models\Form2Search;
use core\controllers\AdminController;
use yii\web\HttpException;
use yii\filters\VerbFilter;

/**
 * Form2Controller implements the CRUD actions for Form2 model.
 */
class Form2Controller extends AdminController
{

    public function init()
    {
        $this->modelClass = Form2::class;
        $this->searchClass = Form2Search::class;
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

    /**
     * Creates a new Form2 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Form2();
        if(Yii::$app->request->get('purchaseGlobalId') != null){
            $model->purchaseGlobalId = intval(Yii::$app->request->get('purchaseGlobalId'));
            $model->prevFormId = intval(Yii::$app->request->get('prevFormId'));
            $model->prevRecordId = intval(Yii::$app->request->get('prevRecordId'));
            $model->prevExpertId = intval(Yii::$app->request->get('prevExpertId'));

            // check expert validation
            $sql = "SELECT tableName FROM nad_purchase_forms_lookup WHERE id = :prevFormId";
            $prevFormTableName = \Yii::$app->db->createCommand($sql)->bindValue(':prevFormId', $model->prevFormId)->queryScalar();

            if($prevFormTableName == 'nad_purchase_form1')
                $columnName = 'id';
            else
                $columnName = 'prevRecordId';

            $sql2 = "SELECT * FROM {$prevFormTableName} WHERE {$columnName} = :prevRecordId";
            $prevFormRecord = \Yii::$app->db->createCommand($sql2)->bindValue(':prevRecordId', $model->prevRecordId)->queryOne();

            // if(isset($prevFormRecord) && !empty($prevFormRecord) && $prevFormRecord['nextExpertId'] != \Yii::$app->user->id)
            //     throw new HttpException(403, 'شما دسترسی لازم به صفحه درخواستی را ندارید!');

            return $this->render('create', [
                'model' => $model,
            ]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!$model->delete()) {
            foreach ($model->getErrors('id') as $error) {
                Yii::$app->session->addFlash('error', $error);
            }
            return $this->redirect(['form2/view', 'id' => $id]);
        } else {
            Yii::$app->session->addFlash(
                'success',
                'داده مورد نظر با موفقیت از سیستم حذف شد.'
            );
        }
        return $this->redirect(['form1/index']);
    }
}
