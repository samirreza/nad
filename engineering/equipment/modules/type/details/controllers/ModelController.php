<?php

namespace nad\engineering\equipment\modules\type\details\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use core\controllers\AjaxAdminController;
use nad\engineering\equipment\modules\type\models\Type;
use nad\engineering\equipment\modules\type\details\models\Model;
use nad\engineering\equipment\modules\type\details\models\ModelSearch;

class ModelController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Model::class;
        $this->searchClass = ModelSearch::class;
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
                            'roles' => ['equipment.type']
                        ]
                    ]
                ]
            ]
        );
    }

    public function beforeAction($action)
    {
        if ($action->id == 'index') {
            $typeId = Yii::$app->request->get('typeId');
            if (null == $typeId || null == Type::findOne($typeId)) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
        return parent::beforeAction($action);
    }

    public function actionCreate()
    {
        $model = new Model;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode([
                'status' => 'success',
                'message' => 'داده مورد نظر با موفقیت در سیستم درج شد.'
            ]);
            exit;
        }
        echo Json::encode([
            'content' => $this->renderAjax('_form', [
                'model' => $model,
                'type' => Type::findOne(Yii::$app->request->post('typeId'))
            ])
        ]);
        exit;
    }
}
