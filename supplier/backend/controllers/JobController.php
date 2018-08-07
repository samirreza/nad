<?php

namespace modules\nad\supplier\backend\controllers;

use core\controllers\AdminController;
use modules\nad\supplier\backend\models\Job;
use modules\nad\supplier\backend\models\JobSearch;

class JobController extends AdminController
{
    public function init()
    {
        $this->modelClass = Job::class;
        $this->searchClass = JobSearch::class;
        parent::init();
    }
}
