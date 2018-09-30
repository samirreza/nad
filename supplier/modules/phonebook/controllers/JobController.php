<?php

namespace modules\nad\supplier\modules\phonebook\controllers;

use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use modules\nad\supplier\modules\phonebook\models\Job;
use modules\nad\supplier\modules\phonebook\models\JobSearch;

class JobController extends AjaxAdminController
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
        $this->modelClass = Job::class;
        $this->searchClass = JobSearch::class;
        parent::init();
    }
}
