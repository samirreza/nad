<?php

namespace modules\nad\equipment\modules\document\controllers;

use Yii;
use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
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

    public function actionIndex()
    {
        $searchModel = new DocumentSearch();
        $params = Yii::$app->request->queryParams;
        $params[$searchModel->formName()]['equipmentTypeId'] =
            Yii::$app->request->get('equipmentTypeId');
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}
