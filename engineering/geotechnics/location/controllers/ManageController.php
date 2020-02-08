<?php

namespace nad\engineering\geotechnics\location\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\geotechnics\location\models\Location;
use nad\engineering\geotechnics\location\models\LocationSearch;
use nad\common\modules\engineering\location\controllers\ManageController as ParentController;

class ManageController extends ParentController
{
    public function init()
    {
        $this->modelClass = Location::class;
        $this->searchClass = LocationSearch::class;
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
                            // 'roles' => ['nad.engineering.geotechnics.location']
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }
}
