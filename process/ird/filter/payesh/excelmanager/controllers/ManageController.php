<?php

namespace nad\process\ird\filter\payesh\excelmanager\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\ird\filter\payesh\excelmanager\models\ExcelFile;
use nad\process\ird\filter\payesh\excelmanager\models\ExcelFileSearch;
use nad\common\modules\excelmanager\controllers\ManageController as BaseController;

class ManageController extends BaseController
{
    public function init()
    {
        $this->modelClass = ExcelFile::class;
        $this->searchClass = ExcelFileSearch::class;
    }

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => [
                                'delete',
                                'create',
                                'update'
                            ],
                            'roles' => ['process_department_manager']
                        ]
                    ]
                ]
            ]
        );
    }
}
