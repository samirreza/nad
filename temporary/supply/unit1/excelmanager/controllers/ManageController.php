<?php

namespace nad\temporary\supply\unit1\excelmanager\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\temporary\supply\unit1\excelmanager\models\ExcelFile;
use nad\temporary\supply\unit1\excelmanager\models\ExcelFileSearch;
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
                                'index',
                                'view',
                                'create',
                                'update'
                            ],
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }
}
