<?php

namespace modules\nad\repairer\backend\modules\phonebook\controllers;

use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use modules\nad\repairer\backend\models\Repairer;
use modules\nad\repairer\backend\modules\phonebook\models\Phonebook;
use modules\nad\repairer\backend\modules\phonebook\models\PhonebookSearch;

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
                                'repairer.create',
                                'repairer.update',
                                'repairer.delete'
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

    public function actionList($repairerId)
    {
        $searchModel = new PhonebookSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $repairer = Repairer::findOne($repairerId);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'repairerId' => $repairerId,
            'repairer' => $repairer,
        ]);
    }
}