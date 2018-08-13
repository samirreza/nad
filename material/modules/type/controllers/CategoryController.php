<?php
namespace modules\nad\material\modules\type\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\AccessControl;
use modules\nad\material\modules\type\models\Category;
use modules\nad\material\modules\type\models\CategorySearch;

class CategoryController extends \core\controllers\AjaxAdminController
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
                            'roles' => ['material.type'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function init()
    {
        $this->modelClass = Category::className();
        $this->searchClass = CategorySearch::className();
        parent::init();
    }

    public function actionCreate()
    {
        $category = new Category();
        $category->loadDefaultValues();
        if ($category->load(Yii::$app->request->post())) {
            if ($category->parentId != 0) {
                $parent =  Category::findOne($category->parentId);
                $success = $category->appendTo($parent);
            } else {
                $success = $category->makeRoot();
            }
            if ($success) {
                echo Json::encode([
                    'status' => 'success',
                    'message' => 'داده مورد نظر با موفقیت در سیستم درج شد.'
                ]);
                exit;
            }
        }
        echo Json::encode([
            'content' => $this->renderAjax('_form', ['model' => $category])
        ]);
        exit;
    }

    public function actionUpdate($id)
    {
        $category = $this->findModel($id);
        if ($category->load(Yii::$app->request->post())) {
            if ($category->parentId != '0') {
                $parent = $category->parents(1)->one();
                if (!isset($parent) or $parent->id != $category->parentId) {
                    $newParent = Category::findOne($category->parentId);
                    $success = $category->appendTo($newParent);
                } else {
                    $success = $category->save();
                }
            } else {
                $success = $category->isRoot() ? $category->save()
                    : $category->makeRoot();
            }
            if ($success) {
                echo Json::encode([
                    'status' => 'success',
                    'message' => 'داده مورد نظر با موفقیت در سیستم ویرایش شد.'
                ]);
                exit;
            }
        }
        echo Json::encode([
            'content' => $this->renderAjax('_form', ['model' => $category])
        ]);
        exit;
    }
}
