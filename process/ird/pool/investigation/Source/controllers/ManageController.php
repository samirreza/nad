<?php

namespace nad\process\ird\pool\investigation\source\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\ird\pool\investigation\source\models\source;
use nad\process\ird\pool\investigation\source\models\sourceSearch;
use nad\common\modules\investigation\source\controllers\sourceController;

class ManageController extends sourceController
{
    public function init()
    {
        $this->modelClass = source::class;
        $this->searchClass = sourceSearch::class;
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
                                'certificate'
                            ],
                            'roles' => ['pool.investigation']
                        ]
                    ]
                ]
            ]
        );
    }
}
