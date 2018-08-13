<?php

namespace modules\nad\supplier\backend\modules\phonebook\controllers;

use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use modules\nad\supplier\backend\models\Supplier;
use modules\nad\supplier\backend\modules\phonebook\models\Phonebook;
use modules\nad\supplier\backend\modules\phonebook\models\PhonebookSearch;

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

    public function init()
    {
        $this->modelClass = Phonebook::class;
        $this->searchClass = PhonebookSearch::class;
        parent::init();
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
}
