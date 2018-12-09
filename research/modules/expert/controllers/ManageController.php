<?php

namespace nad\research\modules\expert\controllers;

use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use nad\research\modules\expert\models\Expert;
use nad\research\modules\expert\models\ExpertSearch;

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
                            'roles' => ['research.manage']
                        ]
                    ]
                ]
            ]
        );
    }
}
