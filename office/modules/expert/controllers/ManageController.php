<?php

namespace nad\office\modules\expert\controllers;

use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use nad\office\modules\expert\models\Expert;
use nad\office\modules\expert\models\ExpertSearch;

class ManageController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Expert::class;
        $this->searchClass = ExpertSearch::class;
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
                            'roles' => ['office.manageExpert']
                        ]
                    ]
                ]
            ]
        );
    }
}
