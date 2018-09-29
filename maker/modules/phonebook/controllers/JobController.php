<?php

namespace modules\nad\maker\modules\phonebook\controllers;

use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use modules\nad\maker\modules\phonebook\models\Job;
use modules\nad\maker\modules\phonebook\models\JobSearch;

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
        $this->modelClass = Job::class;
        $this->searchClass = JobSearch::class;
        parent::init();
    }
}
