<?php

namespace nad\common\modules\engineering\stage\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use nad\common\modules\engineering\stage\models\Category;
use nad\common\modules\engineering\stage\models\CategorySearch;

class CategoryController extends \core\controllers\AjaxAdminController
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => \yii\filters\ContentNegotiator::className(),
                    'only' => ['get-json-tree'],
                    'formats' => [
                        'application/json' => \yii\web\Response::FORMAT_JSON,
                    ]
                ],
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
                                'get-json-tree'
                            ],
                            'roles' => ['@']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['manager']
                        ]
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = Category::className();
        $this->searchClass = CategorySearch::className();
        parent::init();
    }

    public function actions()
    {
        return [
            'delete' => [
                'class' => 'core\tree\actions\DeleteAction',
                'modelClass' => Category::className(),
                'isAjax' => true
            ]
        ];
    }

    public function actionGetJsonTree($id)
    {
        if ($id == '0') {
            $root = Category::find()->roots()->one();
        } else {
            $root = $this->findModel($id);
        }
        return $root ? [$root->getFamilyTreeArrayForWidget()] : [];
    }

    public function actionCreate()
    {
        $model = new $this->modelClass();
        $model->loadDefaultValues();
        if ($model->load(\Yii::$app->request->post())) {
            $transaction = $model::getDb()->beginTransaction();
            if ($model->parentId != 0) {
                $parent =  $this->modelClass::findOne($model->parentId);
                $success = $model->appendTo($parent);
            } else {
                $success = $model->makeRoot();
            }
            if ($success) {
                // $locationIds = Yii::$app->request->post('Category')['locations'];
                // if(isset($locationIds) && $locationIds != ''){
                //     foreach ($locationIds as $locationId) {
                //         Yii::$app->db->createCommand()->insert('nad_eng_location_stage', ['locationId' => $locationId, 'stageCategoryId' => $model->id])->execute();                        
                //     }
                // }
                $transaction->commit();
                return $this->renderSuccess($model);
            }
            $transaction->rollBack();
        }

        return $this->renderForm($model);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $transaction = $model::getDb()->beginTransaction();
            if ($model->parentId != '0') {
                $parent = $model->parents(1)->one();
                if (!isset($parent) or $parent->id != $model->parentId) {
                    $newParent = $this->modelClass::findOne($model->parentId);
                    $success = $model->appendTo($newParent);
                } else {
                    $success = $model->save();
                }
            } else {
                $success = $model->isRoot() ? $model->save()
                    : $model->makeRoot();
            }
            if ($success) {
                // Yii::$app->db->createCommand()->delete('nad_eng_location_stage', ['stageCategoryId' => $model->id])->execute();
                //     $locationIds = Yii::$app->request->post('Category')['locations'];
                //     if(isset($locationIds) && $locationIds != ''){
                //         foreach ($locationIds as $locationId) {
                //             Yii::$app->db->createCommand()->insert('nad_eng_location_stage', ['locationId' => $locationId, 'stageCategoryId' => $model->id])->execute();                        
                //         }
                //     }
                $transaction->commit();
                return $this->renderSuccess($model);
            }
            $transaction->rollBack();
        }
        return $this->renderForm($model);
    }

    protected function renderSuccess($model)
    {
        $msg = [
            'status' => 'success',
            'message' => 'عملیات با موفقیت انجام شد.'
        ];
        echo Json::encode($msg);
        exit;        
    }

    protected function renderForm($model)
    {
        $data = ['model' => $model];        
        echo Json::encode(['content' => $this->renderAjax('_form', $data)]);
        exit;            
    }
}
