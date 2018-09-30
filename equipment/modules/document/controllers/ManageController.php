<?php

namespace modules\nad\equipment\modules\document\controllers;

use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use modules\nad\equipment\modules\type\models\Type;
use modules\nad\equipment\modules\document\models\Document;
use modules\nad\equipment\modules\document\models\DocumentSearch;

class ManageController extends AjaxAdminController
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
                            'roles' => ['equipment.document']
                        ]
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = Document::class;
        $this->searchClass = DocumentSearch::class;
        parent::init();
    }

    public function actionList($typeId)
    {
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $type = Type::findOne($typeId);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'typeId' => $typeId,
            'type' => $type,
        ]);
    }
}