<?php

namespace nad\engineering\stage\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use nad\engineering\stage\models\Stage;
use nad\engineering\stage\models\Category;
use nad\engineering\location\models\Location;
use nad\engineering\stage\models\StageSearch;

class ManageController extends \core\controllers\AjaxAdminController
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'view',
                                'create',
                                'delete',
                                'tree-list',
                                'get-json-tree',
                                'report'
                            ],
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update', 'report'],
                            'roles' => ['manager']
                        ]
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = Stage::className();
        $this->searchClass = StageSearch::className();
        parent::init();
    }

    public function actionCreate()
    {
        $model = new $this->modelClass;
        if (!empty($this->modelScenario)) {
            $model->scenario = $this->modelScenario;
        }
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post())) {
            $transaction = $model::getDb()->beginTransaction();
            try{                
                if($model->save()){
                    $locationIds = Yii::$app->request->post('Stage')['locations'];
                    if(isset($locationIds) && $locationIds != ''){
                        foreach ($locationIds as $locationId) {
                            Yii::$app->db->createCommand()->insert('nad_eng_location_stage', ['locationId' => $locationId, 'stageId' => $model->id])->execute();                        
                        }
                    }
                    $transaction->commit();
                    echo Json::encode([
                        'status' => 'success',
                        'message' => 'داده مورد نظر با موفقیت در سیستم درج شد.'
                    ]);
                    exit;
                }
            } catch(\Throwable $e) {
                $transaction->rollBack();
                echo Json::encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
                exit;
            }                        
        }
        echo Json::encode(
            [
                'content' => $this->renderAjax('_form', ['model' => $model])
            ]
        );
        exit;
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (!empty($this->modelScenario)) {
            $model->scenario = $this->modelScenario;
        }
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post())) {
            $transaction = $model::getDb()->beginTransaction();
            try{                
                if($model->save()){
                    Yii::$app->db->createCommand()->delete('nad_eng_location_stage', ['stageId' => $model->id])->execute();
                    $locationIds = Yii::$app->request->post('Stage')['locations'];
                    if(isset($locationIds) && $locationIds != ''){
                        foreach ($locationIds as $locationId) {
                            Yii::$app->db->createCommand()->insert('nad_eng_location_stage', ['locationId' => $locationId, 'stageId' => $model->id])->execute();                        
                        }
                    }
                    $transaction->commit();
                    echo Json::encode([
                        'status' => 'success',
                        'message' => 'داده مورد نظر با موفقیت در سیستم درج شد.'
                    ]);
                    exit;
                }
            } catch(\Throwable $e) {
                $transaction->rollBack();
                echo Json::encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
                exit;
            }                        
        }
        echo Json::encode(
            [
                'content' => $this->renderAjax('_form', ['model' => $model])
            ]
        );
        exit;
    }

    public function actionTreeList()
    {
        return $this->render('tree');
    }

    public function actionGetJsonTree($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $roots = Category::find()->roots()->all();
        $tree = [];
        foreach ($roots as $root) {
            $tree[] = $root->getFamilyTreeArrayForWidget();
        }
        return $tree;
    }

    public function actionReport()
    {
        return $this->render('report');
    }
}
