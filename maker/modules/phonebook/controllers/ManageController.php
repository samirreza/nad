<?php

namespace modules\nad\maker\modules\phonebook\controllers;

use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use modules\nad\maker\models\Maker;
use modules\nad\maker\modules\phonebook\models\Phonebook;
use modules\nad\maker\modules\phonebook\models\PhonebookSearch;

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
                                'maker.create',
                                'maker.update',
                                'maker.delete'
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

    public function actionList($makerId)
    {
        $searchModel = new PhonebookSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $maker = Maker::findOne($makerId);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'makerId' => $makerId,
            'maker' => $maker,
        ]);
    }
}
