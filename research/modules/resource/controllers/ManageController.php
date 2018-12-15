<?php

namespace nad\research\modules\resource\controllers;

use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use nad\research\modules\resource\models\Resource;
use nad\research\modules\resource\models\ResourceSearch;

class ManageController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Resource::class;
        $this->searchClass = ResourceSearch::class;
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
                            'roles' => ['expert', 'research.manage']
                        ]
                    ]
                ]
            ]
        );
    }
}
