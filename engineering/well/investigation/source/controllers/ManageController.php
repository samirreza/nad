<?php

namespace nad\engineering\well\investigation\source\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\well\investigation\source\models\Source;
use nad\engineering\well\investigation\source\models\SourceSearch;
use nad\common\modules\investigation\source\controllers\SourceController;

class ManageController extends SourceController
{
    public function init()
    {
        $this->modelClass = Source::class;
        $this->searchClass = SourceSearch::class;
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
                            'roles' => ['nad.engineering.well.investigation']
                        ]
                    ]
                ]
            ]
        );
    }
}
