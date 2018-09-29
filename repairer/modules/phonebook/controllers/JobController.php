<?php

namespace modules\nad\repairer\modules\phonebook\controllers;

use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use modules\nad\repairer\modules\phonebook\models\Job;
use modules\nad\repairer\modules\phonebook\models\JobSearch;

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
        $this->modelClass = Job::class;
        $this->searchClass = JobSearch::class;
        parent::init();
    }
}
