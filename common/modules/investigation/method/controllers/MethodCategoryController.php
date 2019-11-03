<?php

namespace nad\common\modules\investigation\method\controllers;

use yii\web\Response;
use yii\filters\ContentNegotiator;
use core\controllers\AjaxAdminController;

class MethodCategoryController extends AjaxAdminController
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => ContentNegotiator::class,
                    'only' => ['get-json-tree'],
                    'formats' => [
                        'application/json' => Response::FORMAT_JSON
                    ]
                ]
            ]
        );
    }

    public function actions()
    {
        return [
            'create' => [
                'class' => 'core\tree\actions\CreateAction',
                'modelClass' => $this->modelClass,
                'isAjax' => true
            ],
            'update' => [
                'class' => 'core\tree\actions\UpdateAction',
                'modelClass' => $this->modelClass,
                'isAjax' => true
            ],
            'delete' => [
                'class' => 'core\tree\actions\DeleteAction',
                'modelClass' => $this->modelClass,
                'isAjax' => true
            ]
        ];
    }

    public function actionTreeList()
    {
        return $this->render('tree');
    }

    public function actionGetJsonTree($id)
    {
        if ($id == '0') {
            $root = $this->modelClass::find()->roots()->one();
        } else {
            $root = $this->findModel($id);
        }

        return $root ? [$root->getFamilyTreeArrayForWidget()] : [];
    }
}
